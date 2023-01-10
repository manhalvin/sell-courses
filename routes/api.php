<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CategoryCourseController;

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
        // Route::get('register/activate/{uuid}', 'verifyAccount')->name('register_activate');
        Route::post('otp/verification/{user_id}', 'verifyWithOtp')->name('otp.verification');
        Route::post('login', 'login')->name('login');
        Route::put('change-password', 'changePassword')->name('change_password')->middleware('auth:sanctum');
        Route::put('forgot-password', 'forgotPassword')->name('forgot_password');
        Route::prefix('otp/')->name('otp.')->group(function () {
            Route::put('forgot-password', 'forgotPasswordWithOtp')->name('forgot_password');
        });
        Route::delete('logout', 'logout')->name('logout');
    });

});

Route::prefix('admin/')->middleware('auth:sanctum')->group(function () {

    // Route admin: category courses
    Route::controller(CategoryCourseController::class)->group(function () {
        Route::prefix('category/courses')->name('category.courses.')->group(function () {
            Route::get('/', 'index')->name('index');
        });
        Route::prefix('category/course')->name('category.course')->group(function () {
            Route::post('/', 'store')->name('store');
            Route::get('{id}', 'show')->name('show');
            Route::post('action', 'action')->name('action');
            Route::post('{id}', 'update')->name('update');
            Route::delete('{id}', 'destroy')->name('destroy');
        });
    });

    // Route admin: users
    Route::controller(UserController::class)->group(function () {
        Route::prefix('users/')->name('users.')->group(function () {
            Route::get('', 'index')->name('index');
        });
        Route::prefix('user/')->name('user.')->group(function () {
            Route::post('', 'store')->name('store');
            Route::get('{id}', 'show')->name('show');
            Route::post('action', 'action')->name('action');
            Route::put('{id}', 'update')->name('update');
            Route::delete('{id}', 'destroy')->name('destroy');
        });
    });
});
