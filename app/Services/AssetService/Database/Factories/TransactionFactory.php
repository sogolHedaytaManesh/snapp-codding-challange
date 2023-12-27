<?php

namespace App\Services\AssetService\Database\Factories;

use App\Services\AssetService\Enums\TransactionStatusEnum;
use App\Services\AssetService\Models\Cart;
use App\Services\AssetService\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            'cart_id' => Cart::factory()->create(),
            'ref_id' => $this->faker->numberBetween(100, 1000000),
            'amount' => $this->faker->numberBetween(1500, 6000),
            'status' => TransactionStatusEnum::SUCCESS,
        ];
    }

    public function success(): TransactionFactory
    {
        return $this->state(fn () => ['status' => TransactionStatusEnum::SUCCESS]);
    }

    public function failed(): TransactionFactory
    {
        return $this->state(fn () => ['status' => TransactionStatusEnum::FAILED]);
    }
}
