<?php

namespace App\Http\Controllers;

use App\Models\loginModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class login_controller extends Controller
{
    //

    



    public function login(Request $request)
    {
        // 1️⃣ Validate incoming request
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    
        // 2️⃣ Find the user by username (case-sensitive)
        $user = User::where('username', $request->username)->first();
    
        // 3️⃣ Check if user exists and password matches
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'ok' => false,
                'message' => 'Invalid login credentials'
            ], 401);
        }
    
        // 4️⃣ Generate a secure token for this session
        $token = bin2hex(random_bytes(32));
    
        // 5️⃣ Save the token to the user record
        $user->login_token = $token;
        $user->last_login_at = now();
        $user->last_login_ip = $request->ip();
        $user->save();
    
        // 6️⃣ Get menus assigned to this user
        $permissions = DB::table('menus as m')
            ->join('permission as p', 'm.menu_id', '=', 'p.menu_id')
            ->where('p.user_id', $user->user_id) 
            ->select(
                'm.menu_id',
                'm.menu_name',
                'm.des',
                'm.menu_link',
                'm.menu_icon',
                'p.menu_add',
                'p.menu_edit',
                'p.menu_delete',
                'p.menu_details'
            )
            ->get();
    
        // 7️⃣ Return user data, token, and permissions
        return response()->json([
            'ok' => true,
            'access_token' => $token,
            'user' => $user,
            'permissions' => $permissions
        ]);
    }
    






        public function saveusers (Request $request){

            $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:200|unique:users',
                'password' => 'required|string|max:255',
                
    
              ],[
                  // This has our own custom error messages for each validation
                  "username.required" => "username is required",
                  "password.required" => "password is required"
                 
                
                   ]);
        
              if ($validator->fails()) {
                  return response(['errors'=>$validator->errors()->all()], 422);
              }
                
                // Insert
                $insert = new loginModel();
                $insert->username = $request->username;
                $insert->password = Hash::make($request['password']);
                
                
        
        
                $insert -> save();
        
                return response()->json([
                    "okay" => true,
                    "msg" => "New user Saved successfully"
                ]);
            }


           // getll users
        public function getallusers(){
            $allusers = loginModel::paginate(10);

            return response () -> json([
                "okay" =>true,
                "msg"=>"Success",
                "data" => $allusers
            ]);
        }



        //get due by ID. This can be used for dues payment receipt
        public function usersbyid($id){
            $getuserbyid = loginModel::find($id);

            if(!$getuserbyid ){
                return response () ->json([
                    "okay" => false,
                    "msg" => "users Id not found",
                    "data" => null
                ],404);
            }

            return response() -> json([
                "okay" => true,
                "msg" => "Success",
                "data" =>$getuserbyid
            ]);


        }
}
