<?php

use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Tournament\TournamentController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\EHub\LicenseController;
use App\Http\Controllers\League\LeagueController;
use App\Models\tournament\TournamentSubscription;
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

Route::controller(LicenseController::class)->group(function(){
    Route::get('/license', 'showAvailableLicenses');
});

Route::controller(TournamentController::class)->group(function(){
    Route::post('/league/{leagueRoute}/tournament', 'create');
    Route::get('/league/{leagueRoute}/tournament/{tournamentRoute}', 'show');
});

Route::controller(LeagueController::class)->group(function(){
    Route::get('/league/{leagueRoute}', 'show');
});

Route::middleware('auth:sanctum')->group(function() {
    // Route::resource('users', UserController::class);
    // Route::resource('teams', TeamController::class);
    // Route::resource('auth', AuthController::class);

    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::controller(LicenseController::class)->group(function(){
        Route::post('/license/adquire', 'adquireLicense')->name('paypal');
        Route::post('/license/canceled', 'canceledLicensePayment')->name('paypal.payment.canceled');
        Route::post('/license/success', 'adquiredLicense')->name('paypal.payment.successful');
    });

    Route::controller(UserController::class)->group(function(){
        Route::get('/notification', 'getNotifications');
        Route::patch('/notification/{id}', 'setNotificationRead');
        Route::delete('/notification/{id}', 'deleteNotification');

        Route::get('/user/token', 'getToken');
    });

    Route::controller(LeagueController::class)->group(function(){
        Route::post('/league', 'create');
        Route::patch('/league/{id}', 'update');
        Route::delete('/league/{id}', 'delete');
        Route::get('/league', 'show');
    });

    // Tournaments (Subscriptions, Add, Edit, Delete...)
    Route::post('/tournament/{id}/subscription', [TournamentSubscription::class, 'logout']);

    Route::controller(CategoryController::class)->group(function(){
        Route::get('/category', 'showCategories');
    });

    Route::controller(TeamController::class)->group(function(){
        Route::get('/my-team', 'showMyTeams');
        Route::post('/my-team/create', 'create');
        Route::get('/my-team/{id}', 'showMyTeams');
        Route::patch('/my-team/{id}', 'update');
    });
});

Route::fallback(function (){
    abort(404, 'API resource not found');
});
