<?php

namespace App\Http\Controllers\Backend\Chat;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\TwilioServices;
use Auth;
use Illuminate\Http\Request;

class TwilioController extends Controller
{
    protected $twilioServices;

    public function __construct(TwilioServices $twilioServices)
    {
        $this->twilioServices = $twilioServices;
    }

    public function index()
    {

        $user = User::where('id', '!=', Auth::id())->get();
        return view('chat.twilio.index', compact('user'));
    }

    public function chat(Request $request, $id)
    {
        $chat = $this->twilioServices->chat($request, $id);
        $authUser = Auth::user();
        $otherUser = User::find($id);
        $user = User::where('id', '!=', Auth::id())->get();
        return view('chat.twilio.chat', compact('user', 'otherUser', 'authUser', 'chat'));
    }
}
