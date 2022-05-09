<?php

namespace App\Http\Controllers\Backend\Login;

use Storage;
use Socialite;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FacebookController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }
    
    public function test(){
      $image = 'https://lh3.googleusercontent.com/a-/AOh14GjYZIi-X96wdpzuHfJBVU-JBnPOUN7uyLf7tMPWQg=s96-c';
      $contents = file_get_contents($image);
      $name = substr(substr($image, strrpos($image, '/') + 1), 0, 7); 
      Storage::put('public/avatar/' . $name . '.jpg', $contents);
      $avatar = Storage::url('public/avatar/' . basename($name) ) . '.jpg' ?? null ;
      return $avatar;
    }

    public function callback()
    { 
      $getInfo = Socialite::driver('facebook')->user();
      $user = $this->createUser($getInfo,'facebook'); 
      auth()->login($user); 
      return redirect()->to('/profile');
    }
    function createUser($getInfo){
    $user = User::where('email', $getInfo->email)->first();

    if (!$user) {
      $image = $getInfo->avatar;
      $contents = file_get_contents($image);
      $name = substr($image, strrpos($image, '/') + 1);
      Storage::put('public/avatar/' . $name . '.jpg', $contents);
      $avatar = 'public/avatar/' . basename($name)  . '.jpg' ?? null ;
      $user = User::create([
        'name'     => $getInfo->name,
        'email'    => $getInfo->email,
        'avatar'    => $avatar,
        'provider_name' => 'facebook',
        'provider_id' => $getInfo->id
      ]);
    }
    return $user;
  }
}
