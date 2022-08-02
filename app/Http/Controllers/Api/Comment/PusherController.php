<?php

namespace App\Http\Controllers\Api\Comment;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class PusherController extends Controller
{ 
    public function store(Request $request)
    {   
        $data = [
            'user_id' => $request->user_id,
            'content' => $request->comment,
        ];
        $result = Comment::create($data);
        
        return $result;
    } 
}
