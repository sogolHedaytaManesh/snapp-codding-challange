<?php

namespace App\Services\SmsService\Repository;

use App\Services\SmsService\Factory\Contractor\Base;

class SmsServiceRepository extends Base
{
    public static function sendOtp($mobileNumber, $message): void
    {
        parent::getContractorClass()->sendOtp($mobileNumber, $message);
    }

    public static function sendWithdrawTransactionMessage($mobileNumber, $balance): void
    {
        parent::getContractorClass()->sendWithdrawTransactionMessage($mobileNumber, $balance);
    }

    public static function sendDepositTransactionMessage($mobileNumber, $balance): void
    {
        parent::getContractorClass()->sendDepositTransactionMessage($mobileNumber, $balance);
    }
}
