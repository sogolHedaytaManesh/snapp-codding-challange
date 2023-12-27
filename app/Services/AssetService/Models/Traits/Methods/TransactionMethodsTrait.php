<?php

namespace App\Services\AssetService\Models\Traits\Methods;

use App\Services\AssetService\Models\Scopes\TransactionScope;

trait TransactionMethodsTrait
{
    protected static function boot(): void
    {
        parent::boot();

        static::addGlobalScope(new TransactionScope());
    }
}
