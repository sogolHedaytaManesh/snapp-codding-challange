<?php

namespace App\Services\AuthenticationService\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AuthenticationService\Helpers\ResponseHelper;
use App\Services\AuthenticationService\Repository\AuthenticationServiceInterface as AuthenticationService;
use App\Services\AuthenticationService\Requests\SendOTPRequest;
use App\Services\SmsService\Repository\SmsServiceInterface;
use Illuminate\Http\JsonResponse;

class SendOTPController extends Controller
{
    public function __invoke(
        SendOTPRequest $request,
        AuthenticationService $authenticationService,
        SmsServiceInterface $smsService,
    ): JsonResponse {
        $user = $authenticationService->verifyUserExist($request->validated());

        abort_if(is_null($user), code: 401);

        $verificationCode = '3333';

        $authenticationService->update($user, ['verification_code' => $verificationCode]);

        $smsService::sendOtp($user->mobile, $verificationCode);

        return ResponseHelper::success();
    }
}
