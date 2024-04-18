<?php

namespace App\Http\Controllers\Backend\Login;

use App\Http\Controllers\Controller;
use App\Models\User;
use Socialite;
use Storage;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $getInfo = Socialite::driver('google')->user();
        $user = $this->createUser($getInfo, 'google');
        auth()->login($user);
        return redirect()->to('/profile');
    }

    function createUser($getInfo)
    {
        dd($getInfo);
        $user = User::where('email', $getInfo->email)->first();
        if (!$user) {
            $image = $getInfo->avatar;
            $contents = file_get_contents($image);
            $name = renameUploadedFile(substr($image, strrpos($image, '/') + 1));
            Storage::put('public/avatar/' . $name . '.jpg', $contents);
            $avatar = Storage::url('public/avatar/' . basename($name)) . '.jpg' ?? null;
            $user = User::create([
                'name' => $getInfo->name,
                'email' => $getInfo->email,
                'avatar' => $avatar,
                'provider_name' => 'google',
                'provider_id' => $getInfo->id,
                'refresh_token' => $getInfo->token,
            ]);
        } else {
            $user->refresh_token = $getInfo->token;
            $user->update();
        }
        return $user;
    }
}
