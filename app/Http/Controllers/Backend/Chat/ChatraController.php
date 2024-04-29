<?php

namespace App\Http\Controllers\Backend\Chat;

use App\Http\Controllers\Controller;

class ChatraController extends Controller
{
    public function index()
    {
        return view('chat.chatra.index');
    }
}
