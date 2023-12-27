<?php

namespace App\Services\AssetService\Enums;

use App\Services\AssetService\Helpers\EnumHelper;

enum AccountNumberStatusEnum: int
{
    use EnumHelper;

    case ACTIVE = 0;
    case INACTIVE = 1;

    public function text(): string
    {
        return match ($this) {
            self::ACTIVE => 'active',
            self::INACTIVE => 'inactive',
        };
    }
}
