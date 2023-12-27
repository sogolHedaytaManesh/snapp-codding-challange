<?php

namespace App\Services\AssetService\Database\Factories;

use App\Services\AssetService\Enums\AccountNumberStatusEnum;
use App\Services\AssetService\Models\Wage;
use Illuminate\Database\Eloquent\Factories\Factory;

class WageFactory extends Factory
{
    protected $model = Wage::class;

    public function definition(): array
    {
        return [
            'cart_number' => $this->faker->creditCardNumber,
            'ref_id' => $this->faker->numberBetween(100, 1000000),
            'amount' => $this->faker->numberBetween(1500, 6000),
        ];
    }

    public function active(): CartFactory
    {
        return $this->state(fn () => ['is_active' => AccountNumberStatusEnum::ACTIVE]);
    }

    public function inActive(): CartFactory
    {
        return $this->state(fn () => ['is_active' => AccountNumberStatusEnum::INACTIVE]);
    }
}
