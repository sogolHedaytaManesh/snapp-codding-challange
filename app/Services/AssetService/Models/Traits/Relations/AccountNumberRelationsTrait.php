<?php

namespace App\Services\AssetService\Models\Traits\Relations;

use App\Services\AssetService\Models\Cart;
use App\Services\AssetService\Models\Transaction;
use App\Services\AssetService\Models\Wage;
use App\Services\AuthenticationService\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

trait AccountNumberRelationsTrait
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function cartNumbers(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function transactions(): HasManyThrough
    {
        return $this->hasManyThrough(Transaction::class, Cart::class);
    }

    public function wages(): HasManyThrough
    {
        return $this->hasManyThrough(Wage::class, Cart::class);
    }
}
