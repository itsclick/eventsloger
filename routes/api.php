<?php

use App\Http\Controllers\accountManager;
use App\Http\Controllers\dues_controller;
use App\Http\Controllers\event_controller;
use App\Http\Controllers\EventFormController;
use App\Http\Controllers\group_controller;
use App\Http\Controllers\login_controller;
use App\Http\Controllers\EventRegistrationController;
use App\Http\Controllers\menusController;
use App\Http\Controllers\user_controller;
use App\Models\Membership_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['cors', 'json.response']], function () {
    // Your routes go here
    Route::prefix('events')->group(function () {


        Route::post('/saveevents', [event_controller::class, 'saveevents']);
        Route::get('/alleventlist', [event_controller::class, 'alleventlist']);
        Route::get('/eventbyid/{id}', [event_controller::class, 'eventbyid']);
        Route::post('/updateevent/{id}', [event_controller::class, 'updateevent']);
        Route::delete('/deleteEvent/{id}', [event_controller::class, 'deleteEvent']);
        Route::post('/Addeventform/{eventId}', [EventFormController::class, 'Addeventform']);
        Route::get('/publicform/{eventId}', [EventFormController::class, 'publicform']);
        Route::post('/saveregistration/{eventCode}', [EventFormController::class, 'saveregistration']);
        Route::post('/verify/{eventCode}', [EventFormController::class, 'verify']);
        Route::post('/confirm/{eventCode}', [EventFormController::class, 'confirmAttendance']);
        Route::get('/events/eventbyeid/{event_id}', [EventFormController::class, 'eventbyeid']);
        Route::get('/eventbyid/{eid}', [event_controller::class, 'eventbyid']);

        Route::get('/events/{eventCode}/verify-otp', [EventFormController::class, 'verifyOtp']);
        Route::post('/events/{eventCode}/resend-otp', [EventFormController::class, 'resendOtp']);
    });



    Route::prefix('group')->group(function () {

        Route::post('/savegroup', [group_controller::class, 'savegroup']);
        Route::get('/allgroups', [group_controller::class, 'allgroups']);
        Route::get('/groupbyid/{id}', [group_controller::class, 'groupbyid']);
        Route::post('/updategroup/{id}', [group_controller::class, 'updategroup']);
        Route::delete('/deletegroup/{id}', [group_controller::class, 'deletegroup']);
        Route::get('/getgroups', [group_controller::class, 'getgroups']);
        Route::get('/countgroup', [group_controller::class, 'countgroup']);
    });


    Route::prefix('dues')->group(function () {

        Route::post('/savedues', [dues_controller::class, 'savedues']);
        Route::get('/getalldues', [dues_controller::class, 'getalldues']);
        Route::get('/duesbyid/{id}', [dues_controller::class, 'duesbyid']);
        Route::get('/memberdues/{mid}', [dues_controller::class, 'memberdues']);
        Route::delete('/deletedues/{id}', [dues_controller::class, 'deletedues']);
        Route::post('/updateddues/{id}', [dues_controller::class, 'updateddues']);
    });


    Route::prefix('users')->group(function () {

        Route::post('/saveusers', [login_controller::class, 'saveusers']);
        Route::post('/login', [login_controller::class, 'login']);
        Route::get('/getallusers', [accountManager::class, 'getallusers']);
        Route::get('/userpermision/{user_id}', [accountManager::class, 'userpermision']);
        Route::post('/updatepermission', [accountManager::class, 'updatepermission']);
        Route::get('/getallmenus', [menusController::class, 'getallmenus']);
        Route::post('/savemenus', [menusController::class, 'savemenus']);
        Route::delete('/deletemenu/{id}', [menusController::class, 'deletemenu']);
        Route::get('/allpermision/{user_id}', [accountManager::class, 'allpermision']);
        Route::post('/savesystemysers', [user_controller::class, 'savesystemysers']);
    });
});
