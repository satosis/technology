<?php

namespace App\Http\Controllers\Backend\Login;

use App\Http\Controllers\Controller;
use App\Models\User;
use Socialite;
use Storage;

class FacebookController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function test()
    {
        $image = 'https://lh3.googleusercontent.com/a-/AOh14GjYZIi-X96wdpzuHfJBVU-JBnPOUN7uyLf7tMPWQg=s96-c';
        $contents = file_get_contents($image);
        $name = substr(substr($image, strrpos($image, '/') + 1), 0, 7);
        Storage::put('public/avatar/' . $name . '.jpg', $contents);
        return Storage::url('public/avatar/' . basename($name)) . '.jpg' ?? null;
    }

    public function callback()
    {
        $getInfo = Socialite::driver('facebook')->user();
        $user = $this->createUser($getInfo, 'facebook');
        auth()->login($user);
        return redirect()->to('/profile');
    }

    function createUser($getInfo)
    {
        $user = User::where('email', $getInfo->email)->first();

        if (!$user) {
            $image = $getInfo->avatar;
            $contents = file_get_contents($image);
            $name = substr($image, strrpos($image, '/') + 1);
            Storage::put('public/avatar/' . $name . '.jpg', $contents);
            $avatar = 'public/avatar/' . basename($name) . '.jpg' ?? null;
            $user = User::create([
                'name' => $getInfo->name,
                'email' => $getInfo->email,
                'avatar' => $avatar,
                'provider_name' => 'facebook',
                'provider_id' => $getInfo->id
            ]);
        }
        return $user;
    }
}
