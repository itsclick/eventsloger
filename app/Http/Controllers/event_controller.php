<?php

namespace App\Http\Controllers;

use App\Models\event_model;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class event_controller extends Controller
{
    //

    function saveevents(Request $request)
    {

        $validator = Validator::make($request->all(), [


            'ename' => 'required|string|max:255',
            'evsdate' => 'required|string|max:255',
            'evendate' => 'required|string|max:255',
            'evstime' => 'required|string',
            'evenue' => 'required|string',


        ], [
            // This has our own custom error messages for each validation

            "ename.required" => "Event Name is required",
            "evsdate.required" => "Event Start Date is required",
            "evendate.required" => "Event End Date is required",
            "evstime.required" => "Event Time is required",
            "evenue.required" => "Event Venue is required",



        ]);


        // ✅ Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')
                ->store('events', 'public');
        }

        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                "okay" => false,
                "msg" => $validator->errors()->first(), // Return single message
            ], 422);
        }

        // Insert
        $insert = new event_model();
        $insert->eid = $request->eid;
        $insert->ename = $request->ename;
        $insert->evsdate = $request->evsdate;
        $insert->evendate = $request->evendate;
        $insert->evstime = $request->evstime;
        $insert->evendtime = $request->evendtime;
        $insert->evenue = $request->evenue;
        $insert->username = $request->username;
        $insert->image   = $imagePath; // ✅ save image path



        $insert->save();

        return response()->json([
            "okay" => true,
            "msg" => "Event Records Saved successfully"
        ]);
    }

    //fetch all events
    public function alleventlist()
    {
        $allevents = event_model::paginate(10);
        return response()->json([
            "okay" => true,
            "msg" => "success",
            "data" => $allevents
        ]);
    }


    //get event by id
    public function eventbyid($id)
    {
        $eventid = event_model::find($id);
        if (!$eventid) {
            return response()->json([
                "okay" => false,
                "msg" => "No Event ID found",
                "data" => null
            ], 404);
        }
        return response()->json([
            "okay" => true,
            "msg" => "sucess",
            "data" => $eventid
        ]);
    }






    public function updateevent(Request $request, $id)
    {
        $updateevent = event_model::find($id);

        if (!$updateevent) {
            return response()->json([
                "okay" => false,
                "msg"  => "No Event found"
            ], 404);
        }

        // ✅ Validation
        $request->validate([
            'eid'       => 'required|string|max:255',
            'ename'     => 'required|string|max:255',
            'evsdate'   => 'required|string|max:255',
            'evendate'  => 'nullable|string|max:255',
            'evstime'   => 'required|string',
            'evendtime' => 'nullable|string',
            'evenue'    => 'required|string',

            // ✅ Validate ONLY if image is sent
            'image'     => 'sometimes|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        // ✅ Handle image upload ONLY if a new image is provided
        if ($request->hasFile('image')) {

            // Optional: delete old image
            if ($updateevent->image && Storage::disk('public')->exists($updateevent->image)) {
                Storage::disk('public')->delete($updateevent->image);
            }

            // Store new image
            $updateevent->image = $request->file('image')->store('events', 'public');
        }

        // ✅ Update other fields
        $updateevent->eid       = $request->eid;
        $updateevent->ename     = $request->ename;
        $updateevent->evsdate   = $request->evsdate;
        $updateevent->evendate  = $request->evendate;
        $updateevent->evstime   = $request->evstime;
        $updateevent->evendtime = $request->evendtime;
        $updateevent->evenue    = $request->evenue;
        $updateevent->username  = $request->username;

        $updateevent->save();

        return response()->json([
            "okay" => true,
            "msg"  => "Event record updated successfully",
            "data" => $updateevent
        ]);
    }


    //delete event
    public function deleteEvent($id)
    {
        $deleteevent = event_model::find($id);
        if (!$deleteevent) {
            return response()->json([
                "okay" => false,
                "msg" => "No Event found",
                "data" => null
            ], 404);
        }
        $deleteevent->delete();
        return response()->json([
            "okay" => true,
            "msg" => "Event Data Deleted Successuly",
            "data" => $deleteevent
        ]);
    }
}
