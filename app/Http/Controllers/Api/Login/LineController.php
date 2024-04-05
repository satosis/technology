<?php

namespace App\Http\Controllers\Api\Login;

use App\Http\Controllers\Controller;
use App\Services\LineServices;
use Illuminate\Http\Request;

class LineController extends Controller
{
    protected $lineServices;

    public function __construct(LineServices $lineServices)
    {
        $this->lineServices = $lineServices;
    }

    public function webhook(Request $request)
    {
        $result = $this->lineServices->webhook($request);
        return response()->json(['message' => 'OK']);
    }
}
