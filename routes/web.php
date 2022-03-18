<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Payment\PaypayController;
use App\Http\Controllers\Backend\Payment\StripeController;
use App\Http\Controllers\Backend\Payment\PaypalController;
use App\Http\Controllers\Backend\Payment\PaymentController;
use App\Http\Controllers\Backend\Login\LoginController;
use App\Http\Controllers\Backend\Login\LineController;
use App\Http\Controllers\Backend\Chat\ChatController;
use App\Http\Controllers\Backend\Chat\TwilioController;

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
Route::group(['prefix' => 'login'],
    function () {
        Route::get('/paypay', [PaypayController::class, 'index']);
    }
);
Route::group(['prefix' => 'payment'],
    function () {
        Route::get('/', [PaymentController::class, 'index']);
        Route::get('/paypay', [PaypayController::class, 'index']);
        Route::get('/stripe', [StripeController::class, 'index']);
        Route::get('/paypal', [PaypalController::class, 'index']);
    }
);

Route::group(['prefix' => 'login'],
    function () {
        Route::get('/', [LoginController::class, 'index']);
        Route::get('/line', [LineController::class, 'index']);
    }
);

Route::group(['prefix' => 'chat'],
    function () {
        Route::get('/', [ChatController::class, 'index']);
        Route::get('/twilio', [TwilioController::class, 'index']);
    }
);
