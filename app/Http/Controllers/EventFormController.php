<?php

namespace App\Http\Controllers;

use App\Models\EventForm;
use Illuminate\Http\Request;
use App\Models\EventFormField;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\EventFormSubmission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventRegistrationOtpMail;

class EventFormController extends Controller
{
    //
    /**
     * Store / Update form builder
     */
    public function Addeventform(Request $request, $eventId)
    {
        $request->validate([
            'user_id' => 'required|string',   // 👈 coming from Vue
            'fields'  => 'required|array|min:1',
        ]);

        DB::transaction(function () use ($request, $eventId) {

            $form = EventForm::updateOrCreate(
                ['event_id' => $eventId],      // where condition
                [
                    'status'  => 1,
                    'user_id' => $request->user_id, // ✅ FROM VUE
                ]
            );

            // Remove old fields
            $form->fields()->delete();

            // Save fields
            foreach ($request->fields as $index => $field) {
                EventFormField::create([
                    'event_form_id' => $form->id,
                    'label'        => $field['label'],
                    'name'         => $field['name'],
                    'type'         => $field['type'],
                    'is_required'  => $field['required'] ?? false,
                    'options'      => $field['options'] ?? null,
                    'position'     => $index + 1,
                ]);
            }
        });

        return response()->json([
            'ok' => true,
            'msg' => 'Form saved successfully',
        ]);
    }






    /**
     * Get form for public registration
     */
    public function publicform($eventId)
    {
        $form = EventForm::where('event_id', $eventId)
            ->with('fields')
            ->firstOrFail();

        return response()->json($form);
    }
    /**
     * Store user submission
     */
    public function submit(Request $request, $eventId)
    {
        $form = EventForm::where('event_id', $eventId)
            ->with('fields')
            ->firstOrFail();

        // Build validation rules dynamically
        $rules = [];

        foreach ($form->fields as $field) {
            if ($field->is_required) {
                $rules[$field->name] = 'required';
            }
        }

        $validated = $request->validate($rules);

        EventFormSubmission::create([
            'event_form_id' => $form->id,
            'responses' => $validated,
        ]);

        return response()->json([
            'ok' => true,
            'msg' => 'Registration successful',
        ]);
    }


    //save public regisration from form 
    public function saveregistration(Request $request, $eventCode)
    {
        // 1️⃣ Validate event_id
        $request->validate([
            'event_id' => 'required'
        ]);

        // 2️⃣ Ensure route param matches payload
        if ($eventCode !== $request->event_id) {
            return response()->json(['msg' => 'Event mismatch'], 422);
        }

        // 3️⃣ Find the event form
        $form = EventForm::where('event_id', $request->event_id)->first();
        if (!$form) {
            return response()->json(['msg' => 'Form not found'], 404);
        }

        // 4️⃣ Build dynamic validation rules from form fields
        $fields = $form->fields;
        $rules = [];
        foreach ($fields as $f) {
            $fieldRules = [];
            if ($f->is_required) $fieldRules[] = 'required';
            if ($f->type === 'email') $fieldRules[] = 'email';
            if ($fieldRules) $rules[$f->name] = $fieldRules;
        }

        $validated = $request->validate($rules);

        // 5️⃣ Prevent duplicate registration by phone number
        if (!empty($validated['phone_number'])) {
            $exists = EventFormSubmission::where('event_id', $request->event_id)
                ->where('phone_number', $validated['phone_number'])
                ->exists();

            if ($exists) {
                return response()->json(['msg' => 'You have already registered for this event'], 409);
            }
        }

        // 6️⃣ Extract dedicated fields
        $fullName     = $validated['full_name'] ?? null;
        $phoneNumber  = $validated['phone_number'] ?? null;
        $emailAddress = $validated['email_address'] ?? null;
        $gender       = $validated['gender'] ?? null;

        // 7️⃣ Other fields → JSON
        $otherData = $validated;
        unset($otherData['full_name'], $otherData['phone_number'], $otherData['email_address'], $otherData['gender']);

        // 8️⃣ Generate 6-digit OTP
        $otp_plain = random_int(100000, 999999);

        // 9️⃣ Save registration with hashed OTP and expiry
        $submission = EventFormSubmission::create([
            'event_form_id' => $form->id,
            'event_id'      => $request->event_id,
            'user_id'       => $request->user_id,
            'full_name'     => $fullName,
            'phone_number'  => $phoneNumber,
            'email_address' => $emailAddress,
            'gender'        => $gender,
            'otp_code'      => Hash::make($otp_plain),            // hashed OTP
            'otp_expires_at' => Carbon::now()->addMinutes(10),     // OTP expires in 10 min
            'data'          => json_encode($otherData),
        ]);

        // 1️⃣0️⃣ Send email if participant has email
        if ($emailAddress) {
            Mail::to($emailAddress)->send(
                new EventRegistrationOtpMail($otp_plain, $fullName, $request->event_id)
            );
        }

        // 1️⃣1️⃣ Success response
        return response()->json([
            'msg' => 'Registration successful. OTP sent to email.',
            'submission_id' => $submission->id
        ]);
    }





    public function verifyOtp(Request $request, $eventCode)
    {
        // 1️⃣ Validate query parameters
        $request->validate([
            'phone_number' => 'required',
            'otp_code'     => 'required|digits:6',
        ]);

        $phone = $request->query('phone_number');
        $otp   = $request->query('otp_code');

        // 2️⃣ Find participant by event and phone number
        $submission = EventFormSubmission::where('event_id', $eventCode)
            ->where('phone_number', $phone)
            ->first();

        if (!$submission) {
            return response()->json([
                'verified' => false,
                'msg' => 'Participant not found'
            ], 404);
        }

        // 3️⃣ Check if already verified
        if ($submission->verified) {
            return response()->json([
                'verified' => false,
                'msg' => 'Already verified'
            ], 409);
        }

        // 4️⃣ Check if OTP expired
        if (!$submission->otp_expires_at || now()->gt($submission->otp_expires_at)) {
            return response()->json([
                'verified' => false,
                'msg' => 'OTP expired'
            ], 410);
        }

        // 5️⃣ Compare hashed OTP
        if (!Hash::check($otp, $submission->otp_code)) {
            return response()->json([
                'verified' => false,
                'msg' => 'Invalid OTP'
            ], 422);
        }

        // 6️⃣ Mark verified
        $submission->update([
            'verified' => 1,
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);

        return response()->json([
            'verified' => true,
            'submission_id' => $submission->id,
            'full_name'       => $submission->full_name,
            'phone_number'    => $submission->phone_number,
            'gender'          => $submission->gender,
            'msg' => 'Verification successful'
        ]);
    }


















    public function resendOtp(Request $request, $eventCode)
    {
        $request->validate([
            'phone_number' => 'required',
        ]);

        $submission = EventFormSubmission::where('event_id', $eventCode)
            ->where('phone_number', $request->phone_number)
            ->first();

        if (!$submission) {
            return response()->json(['msg' => 'Participant not found'], 404);
        }

        // Generate new OTP
        $otp = random_int(100000, 999999);
        $submission->otp_code = Hash::make($otp);
        $submission->otp_expires_at = now()->addMinutes(10);
        $submission->save();

        // Send via email or SMS
        if ($submission->email_address) {
            Mail::to($submission->email_address)->send(new EventRegistrationOtpMail($otp, $submission->full_name, $eventCode));
        }

        return response()->json(['msg' => 'OTP resent successfully']);
    }






    //get event by eid
    // public function eventbyeid($event_id)
    // {
    //     $event = EventForm::where('event_id', $event_id)->first();

    //     if (!$event) {
    //         return response()->json([
    //             "okay" => false,
    //             "msg" => "No Event ID found",
    //             "data" => null
    //         ], 404);
    //     }

    //     return response()->json([
    //         "okay" => true,
    //         "msg" => "success",
    //         "data" => $event
    //     ]);
    // }


    public function eventbyeid($event_id)
    {
        $event = EventForm::with('registrations')
            ->where('event_id', $event_id)
            ->first();

        if (!$event) {
            return response()->json([
                "okay" => false,
                "msg" => "No Event ID found",
                "data" => null
            ], 404);
        }

        return response()->json([
            "okay" => true,
            "msg" => "success",
            "data" => $event
        ]);
    }






    //verifiy paticipants
    public function verify(Request $request, $eventCode)
    {
        // 1️⃣ Validate input
        $request->validate([
            'phone_number' => 'required'
        ]);

        $phoneNumber = $request->phone_number;

        // 2️⃣ Search in the dedicated phone_number column for this event
        $submission = EventFormSubmission::where('event_id', $eventCode)
            ->where('phone_number', $phoneNumber)
            ->first();

        // 3️⃣ If not found, return false
        if (!$submission) {
            return response()->json(['found' => false]);
        }

        // 4️⃣ Decode the data JSON (other fields)
        $dataArray = $submission->data ? json_decode($submission->data, true) : [];

        // 5️⃣ Merge with metadata
        $responseData = array_merge($dataArray, [
            'full_name'       => $submission->full_name,
            'phone_number'    => $submission->phone_number,
            'email_address'   => $submission->email_address,
            'gender'          => $submission->gender,
            'event_form_id'   => $submission->event_form_id,
            'submission_id'   => $submission->id,
            'attended'        => $submission->attended,
        ]);

        // 6️⃣ Return success
        return response()->json([
            'found' => true,
            'data'  => $responseData
        ]);
    }




    //comfirm attendance
    public function confirmAttendance(Request $request, $eventCode)
    {
        // 1️⃣ Validate input
        $request->validate([
            'phone_number' => 'required',
        ]);

        // 2️⃣ Find participant by event_id and phone_number
        $submission = EventFormSubmission::where('event_id', $eventCode)
            ->where('phone_number', $request->phone_number)
            ->first();

        if (!$submission) {
            return response()->json([
                'msg' => 'Participant not found'
            ], 404);
        }

        // 3️⃣ If already confirmed
        if ($submission->attended == 1) {
            return response()->json([
                'msg' => 'Attendance already confirmed',
                'participant' => [
                    'full_name'    => $submission->full_name,
                    'phone_number' => $submission->phone_number,
                    'gender'       => $submission->gender,
                ]
            ]);
        }

        // 4️⃣ Mark attendance
        $submission->attended = 1;
        $submission->save();

        // 5️⃣ Return success
        return response()->json([
            'msg' => 'Thank you for showing up!',
            'participant' => [
                'full_name'    => $submission->full_name,
                'phone_number' => $submission->phone_number,
                'gender'       => $submission->gender,
            ]
        ]);
    }
}
