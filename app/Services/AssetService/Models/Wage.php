<?php

namespace App\Services\AssetService\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wage extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'cart_id',
        'amount',
    ];
}
