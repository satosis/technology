<?php

namespace App\Http\Controllers\Backend\Video;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\PusherServices;
use App\Http\Controllers\Controller;

class PusherController extends Controller
{
    protected $pusherServices;
    public function __construct(PusherServices $pusherServices)
    {
        $this->pusherServices  = $pusherServices;
    } 
    public function index(){

        $user = User::where('id', '!=', Auth::id())->get();
        return view('video.pusher.index', compact('user'));
    }
    public function video(Request $request, $id){
        $authUser = Auth::user();
        $otherUser = User::find($id);
        $user = User::where('id', '!=', Auth::id())->get();
        return view('video.pusher.video', compact('user', 'otherUser', 'authUser'));
    }

   
}
