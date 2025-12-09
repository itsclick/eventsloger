<?php

namespace App\Http\Controllers;

use App\Models\dues_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class dues_controller extends Controller


{
    //

    public function savedues (Request $request){


        $validator = Validator::make($request->all(), [
            
            'mid' => 'required|string|max:255',
            'gid' => 'required|string|max:255',
            'amt' => 'required|numeric',
            'pdate' => 'required|date',
          // Unique combination of mid + pmonth
            'pmonth' => [
                'required',
                Rule::unique('mdues')->where(function ($query) use ($request) {
                    return $query->where('mid', $request->mid);
                }),
            ],

          ],[
              // This has our own custom error messages for each validation
              
              "mid.required" => "Members ID is required",
              "gid.required" => "Group ID is required",
              "amt.required" => "Amount is required",
              "pdate.required" => "Payment Date is required",
              "pmonth.required" => "Payment Month is required",

             // Custom duplicate month message 👇
            "pmonth.unique" => "Payment for this member already exists for this month.",
               ]);
    
         

                // ❌ if validation fails
            if ($validator->fails()) {
                return response()->json([
                    "okay" => false,
                    "msg" => $validator->errors()->first(), // Return single message
                ], 422);
            }
            
            // Insert
            $insert = new dues_model();
            $insert->did = $request->did;
            $insert->mid = $request->mid;
            $insert->gid = $request->gid;
            $insert->amt =$request->amt;
            $insert->pdate = $request->pdate;
            $insert->pmonth = $request->pmonth;
            
    
    
            $insert -> save();
    
            return response()->json([
                "okay" => true,
                "msg" => "Dues Records Saved successfully"
            ]);
        }
    



        //function to get all dues

        public function getalldues(){
            $alldues = dues_model::paginate(10);

            return response () -> json([
                "okay" =>true,
                "msg"=>"Success",
                "duesdata" => $alldues
            ]);
        }

       
         //get due by ID. This can be used for dues payment receipt
        public function duesbyid($id){
            $getduebyid = dues_model::find($id);

            if(!$getduebyid ){
                return response () ->json([
                    "okay" => false,
                    "msg" => "Dues Id not found",
                    "data" => null
                ],404);
            }

            return response() -> json([
                "okay" => true,
                "msg" => "Success",
                "data" =>$getduebyid
            ]);


        }


        //Get dues by members ID. This can be used for member dues History
        public function memberdues($mid){
            $memberdues = dues_model::where('mid',$mid)->get();

            if($memberdues->isEmpty()){
                return response () ->json([
                    "okay" => false,
                    "msg" => "Dues Id not found",
                    "data" => null
                ],404);
            }

            return response() -> json([
                "okay" => true,
                "msg" => "Success",
                "data" =>$memberdues
            ]);


        }
            // update member dues
            public function updateddues (Request $request, $id){
                $updatedues = dues_model::find($id);

                if(!$updatedues){
                    return response()->json([
                        "okay"=>false,
                        "msg"=>"No payment ID found",
                        "data" =>null
                    ],404);
                }
                $updatedues->did = $request ->did;
                $updatedues->mid = $request ->mid; 
                $updatedues->gid = $request ->gid;
                $updatedues->amt = $request ->amt;
                $updatedues->pdate = $request ->pdate;
                $updatedues->pmonth = $request ->pmonth;

                $updatedues -> save();

                return response()->json([
                    "okay"=>true,
                    "msg"=>"Dues data updated successfully",
                    "data"=>$updatedues
                ]);

            }


            //delete dues
            public function deletedues($id){
                $deletedues = dues_model::find($id);
                if(!$deletedues){
                    return response() ->json([
                        "okay" => false,
                        "msg" => "No payment ID found",
                        "data" => null
                    ],404);
                }
                $deletedues -> delete();
                return response() ->json([
                    "okay"=>true,
                    "msg" =>"Dues Data deleted successfully",
                    
                ]);


            }
    

        
    }

