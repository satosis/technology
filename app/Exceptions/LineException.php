<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Throwable;
use Illuminate\Http\Response;

class LineException extends Exception implements Responsable
{
    public function toResponse($request)
    {
        return response()->json(['error' => json_decode($this->getMessage())->error_description], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
