<?php

namespace App\Http\Controllers\Backend\Login;

use Socialite;
use App\Models\User;
use App\Http\Controllers\Controller;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback()
    { 
      $getInfo = Socialite::driver('google')->user();
      $user = $this->createUser($getInfo,'google'); 
      auth()->login($user); 
      return redirect()->to('/profile');
    }
    function createUser($getInfo){ 
    $user = User::where('email', $getInfo->email)->first();
    if (!$user) {
         $user = User::create([
            'name'     => $getInfo->name,
            'email'    => $getInfo->email,
            'avatar'    => $getInfo->avatar,
            'provider_name' => 'google',
            'provider_id' => $getInfo->id
        ]);
      }
      return $user;
    }
    }
