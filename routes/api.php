<?php

use App\Http\Controllers\Api\Chat\PusherController as PusherChatController;
use App\Http\Controllers\Api\Chat\TwilioController as TwilioChatController;
use App\Http\Controllers\Api\Comment\PusherController as PusherCommentController;
use App\Http\Controllers\Api\Login\LineController;
use App\Http\Controllers\Api\Payment\PaypalController;
use App\Http\Controllers\Api\Payment\VnpayController;
use App\Http\Controllers\Api\Payment\MomoController;
use App\Http\Controllers\Api\Payment\PaypayController;
use App\Http\Controllers\Api\Payment\StripeController;
use App\Http\Controllers\Api\Sms\TwilioController as TwilioSmsController;
use App\Http\Controllers\Api\Sms\VonageController;
use App\Http\Controllers\Api\Video\TwilioController as TwilioVideoController;
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
                Route::post('/', [StripeController::class, 'stripe']);
                Route::post('/webhook', [StripeController::class, 'webhook']);
            }
        );
        Route::group(['prefix' => 'paypal'],
            function () {
                Route::post('/', [PaypalController::class, 'paypal']);
                Route::post('/webhook', [PaypalController::class, 'webhook']);
            }
        );
        Route::group(['prefix' => 'vnpay'],
            function () {
                Route::post('/', [VnpayController::class, 'vnpay']);
                Route::get('/callback', [VnpayController::class, 'callback']);
            }
        );
        Route::group(['prefix' => 'momo'],
            function () {
                Route::post('/', [MomoController::class, 'momo']);
                Route::get('/callback', [MomoController::class, 'callback']);
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

Route::group(['prefix' => 'login'],
    function () {
        Route::group(['prefix' => 'line'],
            function () {
                Route::post('/webhook', [LineController::class, 'webhook']);
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

Route::group(['prefix' => 'sms'],
    function () {
        Route::group(['prefix' => 'vonage'],
            function () {
                Route::post('/send', [VonageController::class, 'send']);
            }
        );
        Route::group(['prefix' => 'twilio'],
            function () {
                Route::post('/send', [TwilioSmsController::class, 'send']);
            }
        );
    }
);

Route::group(['prefix' => 'comment'],
    function () {
        Route::group(['prefix' => 'pusher'],
            function () {
                Route::post('/store', [PusherCommentController::class, 'store']);
            }
        );
    }
);
