<?php

namespace App\Services\SmsService\Factory\Contractor;

class Ghasedak extends Base
{
    public static function sendOtp($mobileNumber, $message): void
    {
        parent::sendOtp($mobileNumber, $message);
    }

    public static function sendWithdrawTransactionMessage($mobileNumber, $balance): void
    {
        //
    }

    public static function sendDepositTransactionMessage($mobileNumber, $balance): void
    {
        //
    }
}
