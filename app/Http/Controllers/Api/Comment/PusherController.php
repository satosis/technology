<?php

namespace App\Http\Controllers\Api\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

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
