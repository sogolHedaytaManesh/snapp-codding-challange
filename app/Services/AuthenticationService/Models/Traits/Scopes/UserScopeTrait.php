<?php

namespace App\Services\AuthenticationService\Models\Traits\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait UserScopeTrait
{
    public function scopeWithLastThreeTransactions($query): Builder
    {
        return $query->orderBy('total_transactions', 'DESC')
            ->with([
                'transactions' => static function ($query) {
                    return $query->orderBy('created_at', 'DESC')->take(10);
                },
            ])
            ->take(3);
    }
}
