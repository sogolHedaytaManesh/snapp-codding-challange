<?php

namespace App\Services\AuthenticationService\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AuthenticationService\Repository\AuthenticationServiceInterface as AuthenticationService;
use App\Services\AuthenticationService\Requests\LoginRequest;
use App\Services\AuthenticationService\Resources\UserResource;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request, AuthenticationService $authenticationService): UserResource
    {
        $user = $authenticationService->login($request->validated());

        abort_unless(! is_null($user), 401);

        $authenticationService->update($user, ['verification_code' => null]);

        return UserResource::make($user)->additional(
            ['meta' => ['token' => $authenticationService->makeToken($user)]]
        );
    }
}
