<?php

namespace App\Services\AssetService\Models\Traits\Relations;

use App\Services\AssetService\Models\AccountNumber;
use App\Services\AssetService\Models\Wage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait TransactionRelationsTrait
{
    public function cart(): BelongsTo
    {
        return $this->belongsTo(AccountNumber::class);
    }

    public function wages(): HasOne
    {
        return $this->hasOne(Wage::class);
    }
}
