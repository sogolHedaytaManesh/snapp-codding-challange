<?php

namespace App\Services\AssetService\Models\Traits\Relations;

use App\Services\AssetService\Models\AccountNumber;
use App\Services\AssetService\Models\Transaction;
use App\Services\AssetService\Models\Wage;
use App\Services\AuthenticationService\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait CartRelationsTrait
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(AccountNumber::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function wages(): HasMany
    {
        return $this->hasMany(Wage::class);
    }
}
