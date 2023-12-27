<?php

namespace App\Services\AssetService\Models\Scopes;

use App\Services\AssetService\Enums\AccountNumberStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ActiveAccountNumberScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $builder->where('account_numbers.is_active', AccountNumberStatusEnum::ACTIVE->value);
    }
}
