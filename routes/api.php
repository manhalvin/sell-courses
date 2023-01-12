<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryCourseController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VideoCourseController;
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
            Route::put('{id}', 'update')->name('update');
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

    // Route admin: course
    Route::controller(CourseController::class)->group(function () {
        Route::prefix('courses/')->name('courses.')->group(function () {
            Route::get('', 'index')->name('index');
        });
        Route::prefix('course/')->name('course.')->group(function () {
            Route::post('', 'store')->name('store');
            Route::get('{id}', 'show')->name('show');
            Route::post('action', 'action')->name('action');
            Route::put('{id}', 'update')->name('update');
            Route::delete('{id}', 'destroy')->name('destroy');
        });
    });

    // Route admin: video course
    Route::controller(VideoCourseController::class)->group(function () {
        Route::prefix('courses/')->name('courses.video.')->group(function () {
            Route::get('{course_id}/video', 'index')->name('index');
        });
        Route::prefix('course/')->name('course.video')->group(function () {
            Route::post('{course_id}/video', 'store')->name('store');
            Route::get('video/{id}', 'show')->name('show');
            Route::post('video/action', 'action')->name('action');
            Route::put('video/{id}', 'update')->name('update');
            Route::delete('video/{id}', 'destroy')->name('destroy');
        });
    });

    // Route admin: posts
    Route::controller(PostController::class)->group(function () {
        Route::prefix('posts/')->name('posts.')->group(function () {
            Route::get('', 'index')->name('index');
        });
        Route::prefix('post/')->name('post.')->group(function () {
            Route::post('', 'store')->name('store');
            Route::get('{id}', 'show')->name('show');
            Route::post('action', 'action')->name('action');
            Route::put('{id}', 'update')->name('update');
            Route::delete('{id}', 'destroy')->name('destroy');

            Route::prefix('images/')->name('images.')->group(function () {
                Route::post('{post_id}', 'uploadImage')->name('upload_images');
                Route::delete('{post_id}', 'deleteAllImage')->name('delete_all_image');
            });
        });

    });

    // Route admin: orders
    Route::controller(OrderController::class)->group(function () {
        Route::prefix('orders/')->name('orders.')->group(function () {
            Route::get('', 'index')->name('index');
        });
        Route::prefix('order/')->name('order.')->group(function () {
            Route::get('{id}', 'show')->name('show');
            Route::put('{id}', 'update')->name('update');
            Route::delete('{id}', 'destroy')->name('destroy');
            Route::post('action', 'action')->name('action');
        });

    });
});

Route::prefix('client')->name('client.')->middleware('auth:sanctum')->group(function () {

    // Route Client: Post
    Route::controller(App\Http\Controllers\Client\PostController::class)->group(function () {
        Route::prefix('posts')->name('post.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/detail/{id}', 'show')->name('show');
        });
    });

    // Route Client: Course
    Route::controller(App\Http\Controllers\Client\CourseController::class)->group(function () {
        Route::prefix('courses')->name('courses.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/category/{category_id}', 'getCoursesByCategory')->name('category');
            Route::post('/enroll', 'enroll')->name('enroll');
            Route::get('/detail/{course_id}', 'show')->name('show');
        });
    });

    // Route Client: User
    Route::controller(App\Http\Controllers\Client\UserController::class)->group(function () {
        Route::prefix('users/')->name('users.')->group(function () {
            Route::prefix('profile')->name('profile.')->group(function () {
                Route::post('/', 'updateProfile')->name('update');
                Route::get('/', 'infoProfile')->name('info');
            });
        });
    });

    // Route Client: Order
    Route::controller(App\Http\Controllers\Client\OrderController::class)->group(function () {
        Route::prefix('orders/')->name('orders.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{order_id}', 'show')->name('show');
            Route::post('/payment', 'payment')->name('payment');
        });
    });

});
