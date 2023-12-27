<?php

namespace App\Services\AssetService\Helpers;

trait EnumHelper
{
    public static function asSelectArray(): array
    {
        $values = [];

        foreach (self::cases() as $value) {
            $values[$value->name] = $value->value;
        }

        return $values;
    }

    public static function asJson(): string
    {
        return json_encode(self::asSelectArray(), JSON_THROW_ON_ERROR);
    }
}
