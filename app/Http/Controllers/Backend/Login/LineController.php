<?php

namespace App\Http\Controllers\Backend\Login;

use Log;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class LineController extends Controller
{
    public function redirect(){
        $callback = Config::get('env.line.callback');
        $client = Config::get('env.line.liff_channel_id');
        $url = "https://access.line.me/oauth2/v2.1/authorize?response_type=code&client_id=" . $client . "&redirect_uri=" . $callback ."&state=12345abcde&scope=profile%20email%20openid&nonce=09876xyz";
        return redirect()->to($url);
    }
    public function callback(Request $request){
        Log::info($request->all());
        $tokenUrl = Config::get('env.line.token');
        $callback = Config::get('env.line.callback');
        $client = Config::get('env.line.channel_id');
        $client_secret = Config::get('env.line.channel_secret');
        $response = Http::asForm()->post($tokenUrl, [
            'grant_type' => 'authorization_code',
            'code' => $request->code,
            'redirect_uri' => $callback,
            'client_id' => $client,
            'client_secret' => $client_secret,
        ]);
        dd($response->json());
    }
}
