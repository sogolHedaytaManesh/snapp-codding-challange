<?php

namespace App\Services\AssetService\Models\Scopes;

use App\Services\AssetService\Enums\TransactionStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TransactionScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $builder->where('transactions.status', TransactionStatusEnum::SUCCESS->value);
    }
}
