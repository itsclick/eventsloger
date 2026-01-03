<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventForm;
use App\Models\EventFormSubmission;


class EventRegistrationController extends Controller
{
    // Handle public form submission
    public function submit(Request $request, $eventCode)
    {
        // Find the event
        $event = EventForm::where('event_code', $eventCode)->first();

        if (!$event) {
            return response()->json(['msg' => 'Event not found'], 404);
        }

        // Get the form for the event
        $form = EventForm::where('event_id', $event->id)->first();

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
            // Add more type validation if needed
        }

        // Validate the request
        $validated = $request->validate($rules);

        // Save submission
        EventFormSubmission::create([
            'event_id' => $event->id,
            'data' => json_encode($validated),
        ]);


        return response()->json(['msg' => 'Form submitted successfully']);
    }


    //Get all participants for a specific event
    public function participantsByEvent($eventId)
    {
        $participants = EventForm::where('event_id', $eventId)->get();

        return response()->json([
            "okay" => true,
            "data" => $participants
        ]);
    }
}
