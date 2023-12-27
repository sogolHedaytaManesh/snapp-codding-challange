<?php

namespace App\Services\AssetService\Models;

use App\Services\AssetService\Enums\TransactionStatusEnum;
use App\Services\AssetService\Models\Traits\Methods\TransactionMethodsTrait;
use App\Services\AssetService\Models\Traits\Relations\TransactionRelationsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory,
        TransactionMethodsTrait,
        TransactionRelationsTrait;

    protected $fillable = [
        'cart_id',
        'ref_id',
        'amount',
    ];

    protected $casts = [
        'status' => TransactionStatusEnum::class,
    ];
}
