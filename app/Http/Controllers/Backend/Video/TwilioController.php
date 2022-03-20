<?php

namespace App\Http\Controllers\Backend\Video;

use Auth;
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
        return view('video.twilio.index', compact('user'));
    }
    public function video(Request $request, $id){
        $authUser = Auth::user();
        $otherUser = User::find($id);
        $user = User::where('id', '!=', Auth::id())->get();
        return view('video.twilio.video', compact('user', 'otherUser', 'authUser'));
    }
}
