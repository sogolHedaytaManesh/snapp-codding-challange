<?php

namespace App\Services\AssetService\Enums;

use App\Services\AssetService\Helpers\EnumHelper;

enum TransactionStatusEnum: int
{
    use EnumHelper;

    case SUCCESS = 1;
    case FAILED = 2;

    public function text(): string
    {
        return match ($this) {
            self::SUCCESS => 'success',
            self::FAILED => 'failed',
        };
    }
}
