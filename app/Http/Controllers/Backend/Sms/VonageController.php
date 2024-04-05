<?php

namespace App\Http\Controllers\Backend\Sms;

use App\Http\Controllers\Controller;

class VonageController extends Controller
{
    public function index()
    {
        return view('sms.vonage.index');
    }
}
