<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class DateController extends Controller
{
    public function index(){
        return view('date.index');
    }
}
