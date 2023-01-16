<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ClientOrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

// Route Client: Order
Route::controller(ClientOrderController::class)->group(function () {
    Route::prefix('orders/')->middleware('auth')->name('orders.')->group(function () {
        Route::post('/completecheckout', 'completeCheckout')->name('complete_checkout');
        Route::get('/completecheckout', 'completeCheckout')->name('complete_checkout');
    });
});
