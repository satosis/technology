<?php

namespace App\Services;

use App\Models\Chat;
use Auth;
use Config;
use DB;
use Log;
use Storage;

class PusherServices
{
    public function chat($id)
    {
        $chats = Chat::where('gate', 'pusher')->whereNotNull('chat')
            ->where(function ($query) use ($id) {
                $query->where('author', '=', Auth::id())->where('other', '=', $id);
            })->orWhere(function ($query) use ($id) {
                $query->where('author', '=', $id)->where('other', '=', Auth::id());
            })->orderBy('id', 'desc')->get();
        return $chats;
    }

    public function upload($request)
    {
        $message = $request->message;
        if ($request->hasFile('message')) {
            $file = $message->store('public/chat');
        }
        $chat = Chat::create([
            'author' => $request->author,
            'other' => $request->other,
            'chat' => Storage::url('public/chat/' . basename($file)),
            'type' => $request->type,
            'gate' => 'pusher'
        ]);
        return $chat;
    }

    public function store($request)
    {
        $chat = Chat::create([
            'author' => $request->author,
            'other' => $request->other,
            'chat' => $request->chat,
            'type' => $request->type,
            'gate' => 'pusher'
        ]);
        return $chat;
    }
}
