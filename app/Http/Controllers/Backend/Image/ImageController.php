<?php

namespace App\Http\Controllers\Backend\Image;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index(){
        return view('image.index');
    }
}
