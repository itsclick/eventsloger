<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\groups_model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class group_controller extends Controller
{
    //


    public function savegroup (Request $request){


        $validator = Validator::make($request->all(), [
                   
                'gname' =>'required|string|max:255',

          ],
          [
              // This has our own custom error messages for each validation
             
              "gname.required" => "Group Name  is required"
              
            
               ]);
    
          if ($validator->fails()) {
              return response(['errors'=>$validator->errors()->all()], 422);
          }
            
            // Insert
            $insert = new groups_model();
            $insert->gid = $request->gid;
            $insert->gname = $request->gname;
            
            $insert -> save();
    
            return response()->json([
                "okay" => true,
                "msg" => "Group Records Saved successfully"
            ]);
        }


 


     //function to get all group list
     public function allgroups(){
        $allgroups = groups_model::paginate(10);
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

    public function getGroups()
{
    return response()->json(groups_model::select('id','gid', 'gname')->get());
}



    //count total groups
    public function countgroup(){
        $totalgroups = groups_model::count();
        return response ()->json([
           'totalgroups' =>  $totalgroups,
          
    
        ]);
    }




   

    // public function countMembersPerGroup()
    // {
    //     $groups = groups_model::withCount('members')->get();
    
    //     return response()->json([
    //         'data' => $groups
    //     ]);
    // }

   
    


    



    
}
