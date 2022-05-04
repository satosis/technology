<?php

use Carbon\Carbon;
use App\Models\User;
use function foo\func;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Exceptions\ObjectNotFoundException;

if (!function_exists('formatURL')) {
  function formatURL($url)
  {
    $newUrl = substr($url, -1) == '/' ?  substr($url, 0, strlen($url)-1)  : $url;
    return $newUrl;
  }
}

if (!function_exists('formatString')) {
  function formatString($url)
  {
    $newUrl = strpos($url, "\\n" ) ? str_replace( "\\n", "\n", $url) : $url;
    return $newUrl;
  }
}
if (!function_exists('renameUploadedFile')) {
	function renameUploadedFile($file)
	{
		$extension = explode('.', $file);
		$name = basename(md5($file));
		return Str::random(5) . $name . '.' .end($extension);
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