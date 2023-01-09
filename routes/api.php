<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

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

// Route: Auth
Route::prefix('auth/')->name('auth.')->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::post('register', 'register')->name('register');
        Route::get('register/activate/{uuid}', 'verifyAccount')->name('register_activate');
        Route::post('otp/verification/{user_id}', 'verifyWithOtp')->name('otp.verification');
    });

});
