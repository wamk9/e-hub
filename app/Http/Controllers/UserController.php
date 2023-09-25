<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getNotifications(Request $request)
    {
        $user = $request->user;
        $senha = hash('sha256', $request->pass);
        //return View("welcome");



        if ($user == "admin")
        {
            $data = [ 'message' => 'Notification.'];
            $code = 200;
        }
        else
        {
            $data = [ 'message' => 'User not found.'];
            $code = 404;
        }

        return response()->json($data, $code);
    }
}

/*
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/notifications', [UserController::class, 'getNotifications']);
});
*/
