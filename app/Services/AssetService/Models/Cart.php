<?php

namespace App\Services\AssetService\Models;

use App\Services\AssetService\Enums\CartStatusEnum;
use App\Services\AssetService\Models\Traits\Relations\CartRelationsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use CartRelationsTrait,
        HasFactory,
        SoftDeletes;

    protected $fillable = [
        'user_id',
        'account_number_id',
        'status',
        'cart_number',
    ];

    protected $casts = [
        'status' => CartStatusEnum::class,
    ];
}
