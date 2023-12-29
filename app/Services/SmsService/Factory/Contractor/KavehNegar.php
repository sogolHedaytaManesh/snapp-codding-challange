<?php

namespace App\Services\SmsService\Factory\Contractor;

use App\Services\SmsService\Notifications\KavehnegarNotification;
use Illuminate\Support\Facades\Notification;

class KavehNegar extends Base
{
    public static function sendOtp($mobileNumber, $verificationCode): void
    {
        $text = str_replace('%s', $verificationCode, 'کد فعال سازی: %s');

        Notification::send($mobileNumber, new KavehnegarNotification($text));
    }

    public static function sendWithdrawTransactionMessage($mobileNumber, $balance): void
    {
        $text = str_replace('%s', $balance, 'موجودی حساب پس از کاهش موجودی: %s');

        Notification::send($mobileNumber, new KavehnegarNotification($text));
    }

    public static function sendDepositTransactionMessage($mobileNumber, $balance): void
    {
        $text = str_replace('%s', $balance, 'موجودی حساب پس از افزایش موجودی: %s');

        Notification::send($mobileNumber, new KavehnegarNotification($text));
    }
}
