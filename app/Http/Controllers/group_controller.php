<?php

namespace App\Http\Controllers;

use App\Models\groups_model;
use Illuminate\Http\Request;

class group_controller extends Controller
{
    //

    public function savegroup(Request $request){
       
        {
            // Validate request
            $validated = $request->validate([
                'gid' =>'required|string|max:50|unique:cgroups,gid',   // <-- FIX TABLE NAME
                'gname' =>'required|string|max:255',
            ]);
    
            // Insert
            $insert = new groups_model();
            $insert->gid = $validated['gid'];
            $insert->gname = $validated['gname']; // <-- FIXED
            
    
    
            $insert -> save();
    
            return response()->json([
                "okay" => true,
                "msg" => "Group Records Saved successfully"
            ]);
        }



       
    }


     //function to get all group list
     public function allgroups(){
        $allgroups = groups_model::all();
        return response()->json([
            "okay" => true,
            "msg" => "success",
            "data" => $allgroups
        ]);
    }


    //get group Data by ID
    public function groupbyid( $id){
        $groupbyid = groups_model::find($id);
        if(!$groupbyid){
            return response()->json([
                "okay" => false,
                "msg" => "No Groupd ID found",
                "data" => null
            ],404);
        }
        return response()->json([
            "okay" => true,
            "msg" => "success",
            "data" =>$groupbyid 
        ]);
    }

    //uodate group data
    public function updategroup(Request $request, $id){
        $updategroup = groups_model::find($id);

        if(!$updategroup){
            return response()->json([
                "okay"=>false,
                "msg"=>"No Groupd ID found",
                "data" => null
            ],404);
        }
            $updategroup->gid = $request->gid;
            $updategroup->gname = $request->gname; 
            $updategroup -> save();

            return response()->json([
                "okay"=>true,
                "msg"=>"Group Data updated successfully",
                "data"=>$updategroup
            ]);


    }

    //delete group

    public function deletegroup($id){
        $deletegroup = groups_model::find($id);
        if(!$deletegroup){
            return response()->json([
                "okay"=>false,
                "msg"=>"No Group ID found",
                "data"=>null
            ],404);
        }
        $deletegroup->delete();
        return response()->json([
            "okay"=>true,
            "msg"=>"Group data deleted successully",
            "data"=>$deletegroup
        ]);
    }


    
}
