<?php

namespace App\Services\SmsService\Repository;

interface SmsServiceInterface
{
    public static function sendOtp($mobileNumber, $verificationCode): void;

    public static function sendWithdrawTransactionMessage($mobileNumber, $balance): void;

    public static function sendDepositTransactionMessage($mobileNumber, $balance): void;
}
