<?php

namespace App\Http\Controllers\Backend\Chat;

use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat.index');
    }
}
