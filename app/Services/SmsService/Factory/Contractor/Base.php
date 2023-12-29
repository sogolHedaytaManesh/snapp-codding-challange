<?php

namespace App\Services\SmsService\Factory\Contractor;

use App\Services\SmsService\Repository\SmsServiceInterface;
use Illuminate\Support\Str;

class Base implements SmsServiceInterface
{
    public static function getContractorClass(): SmsServiceInterface
    {
        $className = __NAMESPACE__.'\\'.Str::ucfirst(config('sms.third-party.provider'));

        return new $className();
    }

    public static function sendOtp($mobileNumber, $verificationCode): void
    {
        // TODO: Implement sendOtp() method.
    }

    public static function sendWithdrawTransactionMessage($mobileNumber, $balance): void
    {
    }

    public static function sendDepositTransactionMessage($mobileNumber, $balance): void
    {
    }
}
