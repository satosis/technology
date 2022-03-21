<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Payment\PaypayController;
use App\Http\Controllers\Api\Payment\PaypalController;
use App\Http\Controllers\Api\Payment\StripeController;
use App\Http\Controllers\Api\Chat\TwilioController as TwilioChatController;
use App\Http\Controllers\Api\Chat\PusherController as PusherChatController;
use App\Http\Controllers\Api\Video\TwilioController as TwilioVideoController;

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
Route::group(['prefix' => 'payment'],
    function () {
        Route::group(['prefix' => 'paypay'],
            function () {
                Route::post('/', [PaypayController::class, 'paypay']); 
                Route::post('/webhook', [PaypayController::class, 'webhook']);
            }
        );
        Route::group(['prefix' => 'stripe'],
            function () {
                Route::post('/', [StripeController::class, 'paypal']); 
                Route::post('/webhook', [StripeController::class, 'webhook']);
            }
        );
        Route::group(['prefix' => 'paypal'],
            function () {
                Route::post('/', [PaypalController::class, 'paypal']); 
                Route::post('/webhook', [PaypalController::class, 'webhook']);
            }
        );
    }
);
Route::group(['prefix' => 'chat'],
    function () {
        Route::group(['prefix' => 'twilio'],
        function () {
            Route::get('/list/{room}', [TwilioChatController::class, 'list']); 
            Route::post('/token', [TwilioChatController::class, 'token']); 
            Route::post('/webhook', [TwilioChatController::class, 'webhook']);
            }
        );
        Route::group(['prefix' => 'pusher'],
        function () {
            Route::post('/store', [PusherChatController::class, 'store']);
            Route::post('/upload', [PusherChatController::class, 'upload']);
            }
        ); 
    }
);

Route::group(['prefix' => 'video'],
    function () {
        Route::group(['prefix' => 'twilio'],
        function () {
            Route::post('/token', [TwilioVideoController::class, 'token']); 
            }
        );
    }
);