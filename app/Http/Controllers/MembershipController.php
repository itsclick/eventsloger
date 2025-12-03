<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership_model;

class MembershipController extends Controller
{
    //
    public function savemembers(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'mid' =>'required|string|max:50|unique:member,mid',   // <-- FIX TABLE NAME
            'gid' =>'required|string|max:255',
            'fname' =>'required|string|max:255',
            'lname' =>'required|string|max:255',
            'tele' => 'required|string|max:255',
            'email' =>'required|string|max:255',
            'address' =>'required|string|max:255',
            'gender' => 'required|string|max:10',

        ]);

        // Insert
        $insert = new Membership_model();
        $insert->mid = $validated['mid'];
        $insert->gid = $validated['gid']; // <-- FIXED
        $insert->fname = $validated['fname'];
        $insert->lname = $validated['lname'];
        $insert->tele = $validated['tele'];
        $insert->email = $validated['email'];
        $insert->address = $validated['address'];
        $insert->gender = $validated['gender'];


        $insert->save();

        return response()->json([
            "okay" => true,
            "msg" => "Member Records Saved successfully"
        ]);
    }


    //getallmembers

    public function getmembers(){
        $getmembers = Membership_model::all();
        return response()->json([
            "okay"=>true,
            "msg"=>"success",
            "data"=>$getmembers
        ]);
    }

    //get membership by id
    public function memberbyid($id){
        $memberbyid = Membership_model::find($id);
        if(!$memberbyid){
            return response()->json([
                "okay"=>false,
                "msg"=>"No Member ID found",
                "data"=>null
            ],404);
        }
            return response()->json([
                "okay"=>true,
                "msg"=>"sucess",
                "data"=>$memberbyid
            ]);
        
    
}

            //update membership using id
            public function updatemember(Request $request, $id){

                $updatemember = Membership_model::find($id);

                // If no record found
                if(!$updatemember){
                    return response()->json([
                        "okay" => false,
                        "msg"  => "No Member found",
                        "data" => null
                    ], 404);
                }

                // Update fields
                $updatemember->mid     = $request->mid;
                $updatemember->gid     = $request->gid;
                $updatemember->fname   = $request->fname;
                $updatemember->lname   = $request->lname;
                $updatemember->tele    = $request->tele;
                $updatemember->email   = $request->email;
                $updatemember->address = $request->address;
                $updatemember->gender  = $request->gender;

                $updatemember->save();

                return response()->json([
                    "okay" => true,
                    "msg"  => "Membership Records Updated Successfully",
                    "data" => $updatemember
                ]);
            }


            //delete membership
            public function deletemember($id){
                $deletemember = Membership_model::find($id);
                if(!$deletemember){
                    return response()->json([
                        "okay"=>false,
                        "msg"=>"No Member found",
                        "data"=>null
                    ],404);
                }
                $deletemember->delete();
                return response()->json([
                    "okay"=>true,
                    "msg"=>"Membership Data Deleted Successuly",
                    "data"=> $deletemember
                ]);
            }
}
