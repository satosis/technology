<?php

namespace App\Http\Controllers\Backend\Video;

use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    public function index(){
        return view('video.index');
    }
}
