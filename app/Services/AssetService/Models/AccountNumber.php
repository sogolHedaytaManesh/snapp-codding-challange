<?php

namespace App\Services\AssetService\Models;

use App\Services\AssetService\Enums\AccountNumberStatusEnum;
use App\Services\AssetService\Models\Traits\Relations\AccountNumberRelationsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountNumber extends Model
{
    use AccountNumberRelationsTrait,
        HasFactory,
        SoftDeletes;

    protected $table = 'accounts_number';

    protected $fillable = [
        'user_id',
        'is_active',
        'account_number',
        'balance',
    ];

    protected $casts = [
        'is_active' => AccountNumberStatusEnum::class,
    ];
}
