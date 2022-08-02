<?php

namespace App\Http\Controllers\Backend\Comment;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class PusherController extends Controller
{ 
    public function list()
    {   
        $comment = Comment::with('users')->get();
        return view('comment.pusher', compact('comment'));
    } 
}
