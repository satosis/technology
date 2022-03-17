<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Payment\PaypayController;
use App\Http\Controllers\Api\Payment\PaypalController;
use App\Http\Controllers\Api\Payment\StripeController;

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

Route::group(['prefix' => 'paypay'],
    function () {
        Route::post('/', [PaypayController::class, 'paypay']); 
        Route::post('/webhook', [PaypayController::class, 'webhook']);
    }
);
Route::group(['prefix' => 'stripe'],
    function () {
        Route::post('/register', [StripeController::class, 'register']); 
        Route::post('/webhook', [StripeController::class, 'webhook']);
    }
);
Route::group(['prefix' => 'paypal'],
    function () {
        Route::post('/', [PaypalController::class, 'paypal']); 
        Route::post('/webhook', [PaypalController::class, 'webhook']);
    }
);