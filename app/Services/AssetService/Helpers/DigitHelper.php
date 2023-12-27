<?php

namespace App\Services\AssetService\Helpers;

class DigitHelper
{
    public static function isDigit(mixed ...$values): bool
    {
        foreach ($values as $value) {
            if (! preg_match('/^\d+$/u', $value)) {
                return false;
            }
        }

        return true;
    }

    public static function toEnglishDigit(array $values, string $returnType = 'array'): array|string
    {

        array_walk_recursive($values, static function (&$digit) {
            $digit = self::processValue($digit);
        });

        return ($returnType === 'array') ? $values : implode('', $values);
    }

    public static function toArray(string|int $values): array
    {
        return preg_split('//u', $values, null, PREG_SPLIT_NO_EMPTY);
    }

    protected static function processValue($value): int
    {
        if (! $index = array_search($value, ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'])) {
            if (! $index = array_search($value, ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'])) {
                $index = array_search($value, ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'], true);
            }
        }

        return $index;
    }
}
