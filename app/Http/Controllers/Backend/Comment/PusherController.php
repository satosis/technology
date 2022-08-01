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
        $comment = Comment::all();
        return view('comment.pusher', compact('comment'));
    } 

    public function send(Request $request)
    {   
        $data = [
            'user_id' => Auth::id(),
            'content' => $request->comment,
        ];
        $result = Comment::create($data);
        
        return response()->json($result);
    } 
}
