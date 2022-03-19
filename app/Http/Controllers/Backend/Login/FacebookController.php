<?php

namespace App\Http\Controllers\Backend\Login;

use Socialite;
use App\Models\User;
use App\Http\Controllers\Controller;

class FacebookController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function callback()
    { 
      $getInfo = Socialite::driver('facebook')->user(); 
      $user = $this->createUser($getInfo,'facebook'); 
      auth()->login($user); 
      return redirect()->to('/');
    }
    function createUser($getInfo){
    $user = User::where('email', $getInfo->email)->first();
    if (!$user) {
         $user = User::create([
            'name'     => $getInfo->name,
            'email'    => $getInfo->email,
            'avatar'    => $getInfo->avatar,
            'provider_name' => 'facebook',
            'provider_id' => $getInfo->id
        ]);
      }
      return $user;
    }
    }
