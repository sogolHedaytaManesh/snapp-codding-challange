<?php

namespace App\Services\AssetService\Database\Factories;

use App\Services\AssetService\Enums\AccountNumberStatusEnum;
use App\Services\AssetService\Models\AccountNumber;
use App\Services\AuthenticationService\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountNumberFactory extends Factory
{
    protected $model = AccountNumber::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'account_number' => $this->faker->creditCardNumber,
            'balance' => $this->faker->numberBetween(1500, 6000),
            'is_active' => AccountNumberStatusEnum::ACTIVE,
        ];
    }

    public function active(): AccountNumberFactory
    {
        return $this->state(fn () => ['is_active' => AccountNumberStatusEnum::ACTIVE]);
    }

    public function inActive(): AccountNumberFactory
    {
        return $this->state(fn () => ['is_active' => AccountNumberStatusEnum::INACTIVE]);
    }
}
