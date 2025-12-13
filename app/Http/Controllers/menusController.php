<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\menus;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class menusController extends Controller
{
    //

    public function savemenus (Request $request){


        $validator = Validator::make($request->all(), [
            
            
            'menu_name' => 'required|string|max:255',
            'menu_link' => 'required|string',
            'menu_icon' => '',
            'des'=> 'required|string|max:255',
          

          ],[
              // This has our own custom error messages for each validation
              
              
              "menu_name.required" => "Group ID is required",
              "menu_link.required" => "Amount is required",
              "menu_icon.required" => "Icon is required",
              "des.required" => "Description is required",

            
               ]);
    
         

                // ❌ if validation fails
            if ($validator->fails()) {
                return response()->json([
                    "okay" => false,
                    "msg" => $validator->errors()->first(), // Return single message
                ], 422);
            }
            
            // Insert
            $insert = new menus();
          
            $insert->menu_name = $request->menu_name;
            $insert->menu_link = $request->menu_link;
            $insert->menu_icon =$request->menu_icon;
            $insert->des = $request->des;
           
            
    
    
            $insert -> save();
    
            return response()->json([
                "okay" => true,
                "msg" => "Menus Records Saved successfully"
            ]);
        }



          //getll menus

    public function getallmenus(){
        $getmembers = menus::all();
        return response()->json([
            "okay"=>true,
            "msg"=>"success",
            "data"=>$getmembers
        ]);
    }



    //delete menus

    public function deletemenu($id){
        $deletemenu = menus::find($id);
        if(!$deletemenu){
            return response()->json([
                "okay"=>false,
                "msg"=>"No Menu ID found",
                "data"=>null
            ],404);
        }
        $deletemenu->delete();
        return response()->json([
            "okay"=>true,
            "msg"=>"Group data deleted successully",
            "data"=>$deletemenu
        ]);
    }
}
