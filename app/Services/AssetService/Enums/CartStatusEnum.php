<?php

namespace App\Services\AssetService\Enums;

use App\Services\AssetService\Helpers\EnumHelper;

enum CartStatusEnum: int
{
    use EnumHelper;

    case ACTIVE = 1;
    case INACTIVE = 0;
    case EXPIRED = 2;

    public function text(): string
    {
        return match ($this) {
            self::ACTIVE => 'active',
            self::INACTIVE => 'inactive',
            self::EXPIRED => 'expired',
        };
    }
}
