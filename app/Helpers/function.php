<?php

use App\Exceptions\ObjectNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use function foo\func;

if (!function_exists('formatURL')) {
    function formatURL($url)
    {
        return substr($url, -1) == '/' ? substr($url, 0, strlen($url) - 1) : $url;
    }
}

if (!function_exists('formatString')) {
    function formatString($url)
    {
        return strpos($url, "\\n") ? str_replace("\\n", "\n", $url) : $url;
    }
}
if (!function_exists('renameUploadedFile')) {
    function renameUploadedFile($file)
    {
        $extension = explode('.', $file);
        $name = basename(md5($file));
        return Str::random(5) . $name . '.' . end($extension);
    }
}

if (!function_exists('userLoggedIn')) {
    function userLoggedIn()
    {
        $user = Auth::user();
        if ($user) {
            return $user;
        }
        return null;
    }
}

if (!function_exists('storeLog')) {
    function storeLog($channel, $text)
    {
        Log::channel($channel)->info($text);
        throw new ObjectNotFoundException(__('messages.data_not_found'));
    }
}

if (!function_exists('setCookie')) {
    function setCookie($name, $value)
    {
        $minutes = 60;
        $response = new Response('Set Cookie');
        $response->withCookie(cookie($name, $value, $minutes));
        return $response;
    }
}

if (!function_exists('getCookie')) {
    function getCookie(Request $request, $name)
    {
        return $request->cookie($name);
    }
}


if (!function_exists('execPostRequest')) {
    function execPostRequest($url, $data, $method = "POST")
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
}
