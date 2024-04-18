<?php

use App\Http\Controllers\Backend\Chat\CBoxChatController;
use App\Http\Controllers\Backend\Chat\ChatController;
use App\Http\Controllers\Backend\Chat\PusherController as PusherChatController;
use App\Http\Controllers\Backend\Chat\TwilioController as TwilioChatController;
use App\Http\Controllers\Backend\Comment\PusherController as PusherCommentController;
use App\Http\Controllers\Backend\DateController;
use App\Http\Controllers\Backend\Ads\AdsController;
use App\Http\Controllers\Backend\Ads\GoogleAdsController;
use App\Http\Controllers\Backend\Image\ImageController;
use App\Http\Controllers\Backend\Image\InterventionController;
use App\Http\Controllers\Backend\Image\SpatieController;
use App\Http\Controllers\Backend\Login\FacebookController;
use App\Http\Controllers\Backend\Login\GoogleController;
use App\Http\Controllers\Backend\Login\LineController;
use App\Http\Controllers\Backend\Login\LoginController;
use App\Http\Controllers\Backend\Payment\PaymentController;
use App\Http\Controllers\Backend\Payment\PaypalController;
use App\Http\Controllers\Backend\Payment\PaypayController;
use App\Http\Controllers\Backend\Payment\VnpayController;
use App\Http\Controllers\Backend\Payment\MomoController;
use App\Http\Controllers\Backend\Payment\StripeController;
use App\Http\Controllers\Backend\Profile\UserController;
use App\Http\Controllers\Backend\Sms\SmsController;
use App\Http\Controllers\Backend\Sms\TwilioController as TwilioSmsController;
use App\Http\Controllers\Backend\Sms\VonageController;
use App\Http\Controllers\Backend\Video\TwilioController as TwilioVideoController;
use App\Http\Controllers\Backend\Video\VideoController;
use Illuminate\Support\Facades\Route;

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
Route::get('/profile', [UserController::class, 'index'])->middleware('auth');

Route::get('/test', [FacebookController::class, 'test']);
Route::group(['prefix' => 'payment','middleware' => 'auth'],
    function () {
        Route::get('/', [PaymentController::class, 'index']);
        Route::get('/paypay', [PaypayController::class, 'index']);
        Route::get('/vnpay', [VnpayController::class, 'index']);
        Route::get('/momo', [MomoController::class, 'index']);
        Route::get('/stripe', [StripeController::class, 'index']);
        Route::get('/paypal', [PaypalController::class, 'index']);
    }
);

Route::group(['prefix' => 'login'],
    function () {
        Route::group(['prefix' => 'line'],
            function () {
                Route::get('/', [LineController::class, 'redirect']);
                Route::get('/callback', [LineController::class, 'callback']);
            }
        );
        Route::group(['prefix' => 'google'],
            function () {
                Route::get('/', [GoogleController::class, 'redirect']);
                Route::get('/callback', [GoogleController::class, 'callback']);
            }
        );
        Route::group(['prefix' => 'facebook'],
        function () {
            Route::get('/', [FacebookController::class, 'redirect']);
            Route::get('/callback', [FacebookController::class, 'callback']);
        }
    );
    }
);

Route::group(['prefix' => 'chat','middleware' => 'auth'],
    function () {
        Route::get('/', [ChatController::class, 'index']);
        Route::group(['prefix' => 'twilio'],
            function () {
                Route::get('/', [TwilioChatController::class, 'index']);
                Route::get('/{id}', [TwilioChatController::class, 'chat']);
            }
        );
        Route::group(['prefix' => 'pusher'],
            function () {
                Route::get('/', [PusherChatController::class, 'index']);
                Route::get('/{id}', [PusherChatController::class, 'chat']);
            }
        );
        Route::group(['prefix' => 'cbox'],
            function () {
                Route::get('/', [CBoxChatController::class, 'index']);
                Route::get('/{id}', [CBoxChatController::class, 'chat']);
            }
        );
    }
);

Route::group(['prefix' => 'comment','middleware' => 'auth'],
    function () {
        Route::group(['prefix' => 'pusher'],
        function () {
            Route::get('/', [PusherCommentController::class, 'list']);
            }
        );
    }
);

Route::group(['prefix' => 'video','middleware' => 'auth'],
    function () {
        Route::get('/', [VideoController::class, 'index']);
        Route::group(['prefix' => 'twilio'],
            function () {
                Route::get('/', [TwilioVideoController::class, 'index']);
                Route::get('/{id}', [TwilioVideoController::class, 'video']);
            }
        );
        Route::group(['prefix' => 'pusher'],
            function () {
                // Route::get('/', [PusherVideoController::class, 'index']);
                // Route::get('/{id}', [PusherVideoController::class, 'video']);
            }
        );
    }
);

Route::group(['prefix' => 'sms','middleware' => 'auth'],
    function () {
        Route::get('/', [SmsController::class, 'index']);
        Route::group(['prefix' => 'vonage'],
            function () {
                Route::get('/', [VonageController::class, 'index']);
            }
        );
        Route::group(['prefix' => 'twilio'],
            function () {
                Route::get('/', [TwilioSmsController::class, 'index']);
            }
        );
    }
);

Route::group(['prefix' => 'image','middleware' => 'auth'],
    function () {
        Route::get('/', [ImageController::class, 'index']);
        Route::group(['prefix' => 'intervention'],
            function () {
                Route::get('/', [InterventionController::class, 'index']);
                Route::post('/upload', [InterventionController::class, 'upload']);
            }
        );
        Route::group(['prefix' => 'spatie'],
            function () {
                Route::get('/', [SpatieController::class, 'index']);
                Route::post('/upload', [SpatieController::class, 'upload']);
            }
        );
    }
);

Route::group(['prefix' => 'date'],
    function () {
        Route::get('/', [DateController::class, 'index']);
    }
);
Route::group(['prefix' => 'ads'],
    function () {
        Route::get('/', [AdsController::class, 'index']);
        Route::get('/google', [GoogleAdsController::class, 'index']);
    }
);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
