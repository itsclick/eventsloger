<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\EventForm;
use App\Models\EventFormField;
use App\Models\EventFormSubmission;


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
        // 1️Validate event_id
        $request->validate([
            'event_id' => 'required'
        ]);

        // 2️ Ensure route param matches payload
        if ($eventCode !== $request->event_id) {
            return response()->json([
                'msg' => 'Event mismatch'
            ], 422);
        }

        // 3️ Find the event form
        $form = EventForm::where('event_id', $request->event_id)->first();

        if (!$form) {
            return response()->json(['msg' => 'Form not found'], 404);
        }

        // 4️Get form fields
        $fields = $form->fields;

        // 5️Build dynamic validation rules
        $rules = [];

        foreach ($fields as $f) {
            $fieldRules = [];

            if ($f->is_required) {
                $fieldRules[] = 'required';
            }

            if ($f->type === 'email') {
                $fieldRules[] = 'email';
            }

            if (!empty($fieldRules)) {
                $rules[$f->name] = $fieldRules;
            }
        }

        // 6️Validate input
        $validated = $request->validate($rules);

        // 7️Prevent duplicate registration PER EVENT
        if (isset($validated['phone_number'])) {
            $exists = EventFormSubmission::where('event_id', $request->event_id)
                ->where('phone_number', $validated['phone_number'])
                ->exists();

            if ($exists) {
                return response()->json([
                    'msg' => 'You have already registered for this event'
                ], 409);
            }
        }

        // 8️Extract dedicated fields
        $fullName     = $validated['full_name'] ?? null;
        $phoneNumber  = $validated['phone_number'] ?? null;
        $emailAddress = $validated['email_address'] ?? null;
        $gender       = $validated['gender'] ?? null;

        // 9️ Remove dedicated fields from JSON payload
        $otherData = $validated;
        unset(
            $otherData['full_name'],
            $otherData['phone_number'],
            $otherData['email_address'],
            $otherData['gender']
        );

        // 10️ Save registration
        EventFormSubmission::create([
            'event_form_id' => $form->id,
            'event_id'      => $request->event_id,
            'user_id'       => $request->user_id,
            'full_name'     => $fullName,
            'phone_number'  => $phoneNumber,
            'email_address' => $emailAddress,
            'gender'        => $gender,
            'data'          => json_encode($otherData),
        ]);

        // 11 Success response
        return response()->json([
            'msg' => 'Registration successful'
        ]);
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
            'identifier' => 'required'
        ]);

        $identifier = $request->identifier;

        // 2️⃣ Search in the dedicated phone_number column for this event
        $submission = EventFormSubmission::where('event_id', $eventCode)
            ->where('phone_number', $identifier)
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
    public function confirmAttendance(Request $request, $eventFormId)
    {
        // 1️⃣ Validate input
        $request->validate([
            'phone_number' => 'required',
        ]);

        // 2️⃣ Find participant by event_form_id and phone_number
        $submission = EventFormSubmission::where('event_form_id', $eventFormId)
            ->where('phone_number', $request->phone_number)
            ->first();

        // 3️⃣ If not found
        if (!$submission) {
            return response()->json([
                'msg' => 'Participant not found'
            ], 404);
        }

        // 4️⃣ If already confirmed
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

        // 5️⃣ Mark attendance
        $submission->attended = 1;
        $submission->save();

        // 6️⃣ Return success + participant data
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
