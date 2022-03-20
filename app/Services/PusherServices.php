<?php

namespace App\Services;

use DB;
use Log;
use Auth;
use Config;
use Storage;
use App\Models\Chat;
use App\Events\BroadcastChat;
use App\Models\User;
use Illuminate\Support\Str;

class PusherServices
{ 
   public function chat($id){   
        $chats = Chat::where('gate', 'pusher') 
            ->where(function ($query) use ($id) { 
            $query->where('author', '=', Auth::id())->where('other', '=', $id);
            })->orWhere(function ($query) use ($id) {
                $query->where('author', '=', $id)->where('other', '=', Auth::id());
            })->get();
        return $chats;
   }
   public function store($request) {  
    $chat = Chat::create([
        'author'=> $request->user_id,
        'other' => $request->other,
        'chat'  => $request->chat,
        'type'  => $request->type,
        'gate'  => 'pusher'
    ]);  
    return $chat;
	}
	public function upload($request){ 
		if ($request->hasFile('chat')) {
				$file = $chat->store('public/chat');
		} 
		$chat = Chat::create([
			'author'=> $request->user_id,
			'other' => $request->other,
			'chat'  => Config::get('env.app_url') . Storage::url('public/chat/' . basename($file)) ,
			'type'  => $request->type,
			'gate'  => 'pusher'
		]);
    return $chat ;
}
}
