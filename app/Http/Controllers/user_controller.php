<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class user_controller extends Controller
{

    public function savesystemysers(Request $request)
    {
        // 1️⃣ Validate input
        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:100|unique:users',
            'email'    => 'nullable|email|unique:users',
            'password' => 'required|string|min:6',
            'utype'    => 'required|in:1,2,3',
        ]);

        // 2️⃣ Create user
        $user = User::create([
            'name'          => $request->name,
            'username'      => $request->username,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'utype'         => $request->utype,
            'last_login_at' => null,
        ]);

        // 3️⃣ Return response
        return response()->json([
            'msg'  => 'User created successfully',
            'user' => [
                'user_id'  => $user->user_id,
                'name'     => $user->name,
                'username' => $user->username,
                'email'    => $user->email,
                'utype'    => $user->utype,
            ]
        ]);
    }
}
