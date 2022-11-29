<?php

namespace App\Http\Controllers\Backend\Chat;

use App\Http\Controllers\Controller;

class CBoxChatController extends Controller
{
    public function index()
    {
        return view('chat.cbox.index');
    }
}
