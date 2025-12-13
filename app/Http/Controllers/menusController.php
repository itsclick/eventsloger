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
            
            'menu_id' => 'required|string|max:255',
            'menu_name' => 'required|string|max:255',
            'menu_link' => 'required|string',
            'menu_icon' => 'required|string',
            'des'=> 'required|string',
          

          ],[
              // This has our own custom error messages for each validation
              
              "menu_id.required" => "Menu ID is required",
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
            $insert->menu_id = $request->menu_id;
            $insert->menu_name = $request->menu_name;
            $insert->menu_link = $request->menu_link;
            $insert->menu_icon =$request->menu_icon;
            $insert->des = $request->des;
           
            
    
    
            $insert -> save();
    
            return response()->json([
                "okay" => true,
                "msg" => "Dues Records Saved successfully"
            ]);
        }
}
