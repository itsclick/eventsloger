<?php

namespace App\Http\Controllers;

use App\Models\dues_model;
use Illuminate\Http\Request;

class dues_controller extends Controller
{
    //

    public function savedues (Request $request){

        
            // Validate request
            $validated = $request->validate([
                'did' =>'required|string|max:50|unique:mdues,did',   
                'mid' =>'required|string|max:255',
                'gid' =>'required|string|max:255',
                'amt' =>'required|string|max:255',
                'pdate' =>'required|string|max:255',
                'pmonth' =>'required|string|max:255',
            ]);
    
            // Insert
            $insert = new dues_model();
            $insert->did = $validated['did'];
            $insert->mid = $validated['mid']; 
            $insert->gid = $validated['gid'];
            $insert->amt = $validated['amt'];
            $insert->pdate = $validated['pdate'];
            $insert->pmonth = $validated['pmonth'];
            
    
    
            $insert -> save();
    
            return response()->json([
                "okay" => true,
                "msg" => "Dues Records Saved successfully"
            ]);
        }



        //function to get all dues

        public function getalldues(){
            $alldues = dues_model::all();

            return response () -> json([
                "okay" =>true,
                "msg"=>"Success",
                "data" => $alldues
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
                $updatedues = dues_model::where($id);

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

