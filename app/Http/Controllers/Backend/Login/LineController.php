<?php

namespace App\Http\Controllers\Backend\Login;

use App\Http\Controllers\Controller;

class LineController extends Controller
{
    public function index(){
        return view('login.line.index');
    }
}
