<?php

namespace App\Http\Controllers\Backend\Chat;

use App\Http\Controllers\Controller;

class LivechatController extends Controller
{
    public function index()
    {
        return view('chat.livechat.index');
    }
}
