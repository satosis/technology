<?php

namespace App\Http\Controllers\Backend\Chat;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\PusherServices;
use Auth;
use Illuminate\Http\Request;

class PusherController extends Controller
{
    protected $pusherServices;

    public function __construct(PusherServices $pusherServices)
    {
        $this->pusherServices = $pusherServices;
    }

    public function index()
    {
        $user = User::where('id', '!=', Auth::id())->get();
        return view('chat.pusher.index', compact('user'));
    }

    public function chat(Request $request, $id)
    {
        $chat = $this->pusherServices->chat($id);
        $authUser = Auth::user();
        $otherUser = User::find($id);
        $user = User::where('id', '!=', Auth::id())->get();
        return view('chat.pusher.chat', compact('user', 'otherUser', 'authUser', 'chat'));
    }


}
