<?php

namespace App\Http\Controllers\Backend\Chat;

use Auth;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\TwilioServices;
use App\Http\Controllers\Controller;

class TwilioController extends Controller
{
    protected $twilioServices;
    public function __construct(TwilioServices $twilioServices)
    {
        $this->twilioServices  = $twilioServices;
    } 
    public function index(){

        $user = User::where('id', '!=', Auth::id())->get();
        return view('chat.twilio.index', compact('user'));
    }
    public function chat(Request $request, $id){
        $chat = $this->twilioServices->chat($request, $id);
        $authUser = Auth::user();
        $otherUser = User::find($id);
        $user = User::where('id', '!=', Auth::id())->get();
        return view('chat.twilio.chat', compact('user', 'otherUser', 'authUser', 'chat'));
    }
}
