<?php

use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::controller(AuthController::class)->group(function(){
    Route::post('/auth/register', 'register');
    Route::post('/auth/login', 'login');
});


Route::middleware('auth:sanctum')->group(function() {
    // Route::resource('users', UserController::class);
    // Route::resource('teams', TeamController::class);
    // Route::resource('auth', AuthController::class);

    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::get('/notifications', [UserController::class, 'getNotifications']);

    Route::controller(TeamController::class)->group(function(){
        Route::get('/my-teams', 'showMyTeams');
        Route::post('/my-teams/create', 'create');
        Route::get('/my-teams/{id}', 'showMyTeams');
        Route::patch('/my-teams/{id}', 'update');
    });
});

Route::fallback(function (){
    abort(404, 'API resource not found');
});
