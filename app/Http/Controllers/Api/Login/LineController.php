<?php

namespace App\Http\Controllers\Api\Login;

use Illuminate\Http\Request;
use App\Services\LineServices;
use App\Http\Controllers\Controller;

class LineController extends Controller
{
    protected $lineServices;
    public function __construct(LineServices $lineServices)
    {
        $this->lineServices  = $lineServices;
    } 

    public function webhook(Request $request)
    {
        $result = $this->lineServices->webhook($request);
        return response()->json(['message' => 'OK']);
    }
}
