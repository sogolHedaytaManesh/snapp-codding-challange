<?php

namespace App\Services\AuthenticationService\Models\Traits\Relations;

use App\Services\AssetService\Models\AccountNumber;
use App\Services\AssetService\Models\Cart;
use App\Services\AssetService\Models\Transaction;
use App\Services\AssetService\Models\Wage;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

trait UserRelationsTrait
{
    public function accountNumbers(): HasMany
    {
        return $this->hasMany(AccountNumber::class, 'user_id', 'id');
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

    public function theMostTransactions(): HasManyThrough
    {
        return $this->hasManyThrough(Transaction::class, Cart::class)
            ->whereBetween(
                'transactions.created_at',
                [now()->subMinutes(10)->format('Y-m-d H:i:s'), now()->format('Y-m-d H:i:s')]
            );
    }
}
