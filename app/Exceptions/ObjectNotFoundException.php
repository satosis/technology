<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Throwable;

class ObjectNotFoundException extends Exception implements Responsable
{
    public function toResponse($request)
    {
        return response()->json(['error' => $this->getMessage()], 404);
    }
}
