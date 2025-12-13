<?php

namespace App\Http\Controllers;

use App\Models\menus;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class accountManager extends Controller
{
    //
    public function getallusers(){

        $allusers = User::paginate(10);

        return response () -> json([
            "okay" =>true,
            "msg"=>"Success",
            "data" => $allusers
        ]);



    }



    //permission join to meu tables and menu tables
    public function userpermision($user_id)
{
    $selectmenus = DB::table('menus as M')
        ->leftJoin('permission as P', function ($join) use ($user_id) {
            $join->on('M.menu_id', '=', 'P.menu_id')
                 ->where('P.user_id', '=', $user_id);
        })
        ->select(
            'M.menu_id',
            'M.menu_name',
            'M.des',
            DB::raw('IFNULL(P.menu_add, 0) as menu_add'),
            DB::raw('IFNULL(P.menu_edit, 0) as menu_edit'),
            DB::raw('IFNULL(P.menu_delete, 0) as menu_delete'),
            DB::raw('IFNULL(P.menu_details, 0) as menu_details')
            
        )
        // ->limit(5)
        ->get();

    return response()->json([
        "okay" => true,
        "msg"  => "Success",
        "data" => $selectmenus
    ]);
}


public function updatepermission(Request $request){
    DB::beginTransaction();

    try {

        // Decode nested JSON permission data
        $user_id = $request->user_id;
        $permisiondata = json_decode($request->permdata);  // returns array of objects

        // Track menu_id in new payload
        $newCodes = collect($permisiondata)->pluck('menu_id')->toArray();

        // DELETE permissions not in new payload
        DB::table('permission')
            ->where('user_id', $user_id)
            ->whereNotIn('menu_id', $newCodes)
            ->delete();

        // LOOP THROUGH PERMISSIONS
        foreach ($permisiondata as $q) {

            // Check if permission already exists
            $exists = DB::table('permission')
                ->where('user_id', $user_id)
                ->where('menu_id', $q->menu_id)   // changed to object
                ->exists();

            if ($exists) {

                // UPDATE existing
                DB::table('permission')
                    ->where('user_id', $user_id)
                    ->where('menu_id', $q->menu_id)
                    ->update([
                        'menu_edit'     => $q->menu_edit,
                        'menu_add'      => $q->menu_add,
                        'menu_details'  => $q->menu_details,
                        'menu_delete'   => $q->menu_delete,
                        
                    ]);

            } else {

                // INSERT new
                DB::table('permission')->insert([
                    'user_id'       => $user_id,
                    'menu_id'       => $q->menu_id,
                    'menu_edit'     => $q->menu_edit,
                    'menu_add'      => $q->menu_add,
                    'menu_details'  => $q->menu_details,
                    'menu_delete'   => $q->menu_delete,
                    'cdate'=>Carbon::now()->format('Y-m-d H:i:s'),
                    'cupdate'=>Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            }
        }

        DB::commit();

        return response()->json([
            "ok" => true,
            "msg" => "Permission updated successfully"
        ]);

    } catch (\Throwable $e) {
        DB::rollBack();
        return response()->json([
            "ok" => false,
            "msg" => "Failed to update survey",
            "error" => $e->getMessage()
        ]);
    }
}








    
}

