<?php

namespace App\Http\Controllers\Backend\Image;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Auth;
use Illuminate\Http\Request;
use Image as ImageManager;

class InterventionController extends Controller
{
    public function index()
    {
        $images = Image::where('user_id', Auth::id())->get();
        return view('image.intervention.index', compact('images'));
    }

    public function upload(Request $request)
    {
        $images = $request->images;
        $allImage = Image::where('user_id', Auth::id())->delete();
        $sizeFile = getimagesize($images);
        // $manager = new ImageManager(['driver' => 'imagick']);
        $img = ImageManager::make($images);
        dd($img);
        $image = Image::create([
            'width' => $sizeFile[0],
            'height' => $sizeFile[1],
            'gate' => 'intervention'
        ]);
    }
}
