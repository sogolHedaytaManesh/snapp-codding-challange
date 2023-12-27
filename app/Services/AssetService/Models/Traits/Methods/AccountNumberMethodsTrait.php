<?php

namespace App\Services\AssetService\Models\Traits\Methods;

use App\Services\AssetService\Models\Scopes\ActiveAccountNumberScope;

trait AccountNumberMethodsTrait
{
    protected static function boot(): void
    {
        parent::boot();

        static::addGlobalScope(new ActiveAccountNumberScope());
    }
}
