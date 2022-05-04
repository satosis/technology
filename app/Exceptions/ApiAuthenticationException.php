<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Contracts\Support\Responsable;

class ApiAuthenticationException extends Exception implements Responsable
{
    public function toResponse($request)
    {
        return response()->json(['error' => 'Unauthorized',
                                'status' => Response::HTTP_UNAUTHORIZED
                            ], Response::HTTP_UNAUTHORIZED);
    }
}
