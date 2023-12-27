<?php

namespace App\Services\AssetService\Rules;

use App\Services\AssetService\Helpers\DigitHelper;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateCartFormatNumberRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $validationStatus = false;

        $value = DigitHelper::toArray((int) $value);

        if (count($value) === 16) {
            $validationStatus = true;
            $cardTotal = 0;
            for ($i = 0; $i < 16; $i++) {
                $c = $value[$i];
                if ($i % 2 === 0) {
                    $cardTotal += (($c * 2 > 9) ? ($c * 2) - 9 : ($c * 2));
                } else {
                    $cardTotal += $c;
                }
            }

            if (! ($cardTotal % 10 === 0)) {
                $validationStatus = false;
            }
        }

        if ($validationStatus === false) {
            $fail('The :attribute is invalid.');
        }
    }
}
