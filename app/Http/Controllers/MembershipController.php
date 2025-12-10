<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Membership_model;
use Illuminate\Support\Facades\Validator;

class MembershipController extends Controller
{
    //

    public function savemembers (Request $request){


        $validator = Validator::make($request->all(), [
            
            'gid' =>'required|string|max:255',
            'fname' =>'required|string|max:255',
            'lname' =>'required|string|max:255',
            'tele' => 'required|string|max:255',
            'email' =>'required|string|max:255',
            'address' =>'required|string|max:255',
            'gender' => 'required|string|max:10',

          ],[
              // This has our own custom error messages for each validation
              
              "gid.required" => "Group ID is required",
              "fname.required" => "first Name is required",
              "lname.required" => "last Name is required",
              "tele.required" => "telephone Date is required",
              "email.required" => "email Month is required",
              "address.required" => "Address is required",
              "gender.required" => "Gender is required"
            
               ]);
    
          if ($validator->fails()) {
              return response(['errors'=>$validator->errors()->all()], 422);
          }
            
            // Insert
            $insert = new Membership_model();
            $insert->mid = $request->mid;
            $insert->gid = $request->gid;
            $insert->fname = $request->fname;
            $insert->lname =$request->lname;
            $insert->tele = $request->tele;
            $insert->email = $request->email;
            $insert->address = $request->address;
            $insert->gender = $request->gender;
            
    
    
            $insert -> save();
    
            return response()->json([
                "okay" => true,
                "msg" => "Members Records Saved successfully"
            ]);
        }

        

    //getallmembers

    public function getmembers(){
        $getmembers = Membership_model::paginate(10);
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

                //count total member and by gender
            public function countmembers(){
                $countmembers = Membership_model::count();
                $totalmale = Membership_model::where('gender','Male')->count();
                $totalfemale = Membership_model::where('gender','Female')->count();
                return response ()->json([
                   'totalmembers' =>  $countmembers,
                   'totalmale' =>  $totalmale,
                   'totalfemale' =>  $totalfemale
            
                ]);
            }


          

                public function countMembersPerGroup()
                {
                $data = DB::table('cgroups as g')
                ->leftJoin('member as m', 'm.gid', '=', 'g.gid')
                ->select(
                'g.gid',
                'g.gname',
                DB::raw('COUNT(m.mid) as total_members')
                )
                ->groupBy('g.gid', 'g.gname')
                ->get();

                return response()->json([
                'data' => $data
                ]);
}
        




}
