<?php

namespace App\Http\Controllers\Backend\Login;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Log;
use Str;

class LineController extends Controller
{
    public function redirect()
    {
         Auth::loginUsingId(1);
         return redirect()->to('/');
        $callback = Config::get('env.app_url');
        $client = Config::get('env.line.liff_channel_id');

        $url = "https://access.line.me/oauth2/v2.1/authorize?response_type=code&client_id=" . $client . "&redirect_uri=" . $callback . "&bot_prompt=aggressive&state=12345abcde&scope=openid+profile+email&nonce=09876xyz";
        return redirect()->to($url);
    }

    public function callback(Request $request)
    {
        $tokenUrl = Config::get('env.line.token');
        $verifiUrl = Config::get('env.line.verify');
        $callback = Config::get('env.line.callback');
        $client = Config::get('env.line.liff_channel_id');
        $client_secret = Config::get('env.line.channel_secret');
        $token = Http::asForm()->post($tokenUrl, [
            'grant_type' => 'authorization_code',
            'code' => $request->code,
            'redirect_uri' => $callback,
            'client_id' => $client,
            'client_secret' => $client_secret,
        ]);

        $verify = Http::asForm()->post($verifiUrl, [
            'id_token' => $token['id_token'],
            'client_id' => config('env.line.liff_channel_id'),
        ]);
        $user = $this->createUser($verify->json(), 'line');
        auth()->login($user);
        return redirect()->to('/profile');
    }

    function createUser($getInfo)
    {
        $user = User::where('provider_id', $getInfo['sub'])->first();
        if (!$user) {
            $user = User::create([
                'name' => $getInfo['name'],
                'email' => $getInfo['email'],
                'avatar' => $getInfo['picture'] ?? '',
                'provider_name' => 'line',
                'provider_id' => $getInfo['sub']
            ]);
        }
        return $user;
    }

}
