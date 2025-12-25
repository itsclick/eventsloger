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
        // Find the event form
        $form = EventForm::where('event_id', $eventCode)->first();

        if (!$form) {
            return response()->json(['msg' => 'Form not found'], 404);
        }

        // Decode form fields
        $fields = json_decode($form->fields, true); // Assuming fields stored as JSON

        // Prepare validation rules dynamically
        $rules = [];
        foreach ($fields as $f) {
            if ($f['is_required']) {
                $rules[$f['name']] = 'required';
            }
            if ($f['type'] === 'email') {
                $rules[$f['name']] = 'email';
            }
        }

        // Validate the request
        $validated = $request->validate($rules);

        // Save submission
        EventFormSubmission::create([
            'event_form_id' => $form->id,
            'data' => json_encode($validated), // contains only form fields
            'user_id' => $request->user_id ?? null, // make sure it's passed
        ]);


        return response()->json(['msg' => 'Form submitted successfully']);
    }


    //verifiy paticipants
    public function verify(Request $request, $eventCode)
    {
        $request->validate([
            'identifier' => 'required'
        ]);

        $identifier = $request->identifier;

        $submission = EventFormSubmission::where(function ($q) use ($identifier) {
            $q->where('data->phone_number', $identifier)
                ->orWhere('data->email_address', $identifier);
        })->first();

        if (!$submission) {
            return response()->json(['found' => false]);
        }

        return response()->json([
            'found' => true,
            'data' => array_merge(json_decode($submission->data, true), [
                'event_form_id' => $submission->event_form_id,
                'submission_id' => $submission->id,
                'attended' => $submission->attended,

            ])
        ]);
    }


    //comfirm attendance
    public function confirmAttendance(Request $request, $eventFormId)
    {
        $request->validate([
            'phone_number' => 'required',
        ]);

        $submission = EventFormSubmission::where('event_form_id', $eventFormId)
            ->whereJsonContains('data->phone_number', $request->phone_number)
            ->first();

        if (!$submission) {
            return response()->json(['msg' => 'Participant not found'], 404);
        }

        if ($submission->attended == 1) {
            return response()->json(['msg' => 'Attendance already confirmed']);
        }

        $submission->attended = 1;
        $submission->save();

        return response()->json(['msg' => 'Thank you for showing up!']);
    }
}