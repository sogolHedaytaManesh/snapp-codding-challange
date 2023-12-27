<?php

namespace App\Services\AssetService\Helpers;

use Carbon\Carbon;

class ReferenceIdHelper
{
    public static function generate(string $string): string
    {
        return sha1(Carbon::now()->format('Y-m-d H:i:s').$string);
    }
}
