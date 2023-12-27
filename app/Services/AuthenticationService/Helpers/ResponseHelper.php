<?php

namespace App\Services\AuthenticationService\Helpers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResponseHelper
{
    public static function success(): JsonResponse
    {
        return response()->json(status: Response::HTTP_OK);
    }
}
