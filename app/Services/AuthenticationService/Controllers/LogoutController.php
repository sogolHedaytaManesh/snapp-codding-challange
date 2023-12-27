<?php

namespace App\Services\AuthenticationService\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AuthenticationService\Helpers\ResponseHelper;
use App\Services\AuthenticationService\Repository\AuthenticationServiceInterface as AuthenticationService;
use Illuminate\Http\JsonResponse;

class LogoutController extends Controller
{
    public function __invoke(AuthenticationService $authenticationService): JsonResponse
    {
        $authenticationService->logout();

        return ResponseHelper::success();
    }
}
