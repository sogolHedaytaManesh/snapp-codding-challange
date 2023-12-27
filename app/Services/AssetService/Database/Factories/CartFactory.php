<?php

namespace App\Services\AssetService\Database\Factories;

use App\Services\AssetService\Enums\CartStatusEnum;
use App\Services\AssetService\Models\AccountNumber;
use App\Services\AssetService\Models\Cart;
use App\Services\AuthenticationService\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'account_number_id' => AccountNumber::factory(),
            'cart_number' => $this->faker->creditCardNumber,
            'status' => CartStatusEnum::ACTIVE,
        ];
    }

    public function active(): CartFactory
    {
        return $this->state(fn () => ['status' => CartStatusEnum::ACTIVE]);
    }

    public function inActive(): CartFactory
    {
        return $this->state(fn () => ['status' => CartStatusEnum::INACTIVE]);
    }

    public function expired(): CartFactory
    {
        return $this->state(fn () => ['status' => CartStatusEnum::EXPIRED]);
    }
}
