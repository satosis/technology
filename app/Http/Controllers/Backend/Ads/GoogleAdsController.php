<?php

namespace App\Http\Controllers\Backend\Ads;

use Socialite;
use App\Http\Controllers\Controller;

class GoogleAdsController extends Controller
{
    public function index()
    {
        $access_token = Socialite::driver('google')->getAccessTokenResponse($token);
        $user = Socialite::driver('google')->userFromToken($access_token['access_token']);
        return view('ads.google.index');
    }
}
