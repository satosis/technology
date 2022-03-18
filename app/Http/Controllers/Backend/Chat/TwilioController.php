<?php

namespace App\Http\Controllers\Backend\Chat;

use App\Http\Controllers\Controller;

class TwilioController extends Controller
{
    public function index(){
        return view('chat.twilio.index');
    }
}
