<?php

namespace App\Services\AuthenticationService\Database\Factories;

use App\Services\AuthenticationService\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Ybazli\Faker\Facades\Faker;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'first_name' => Faker::firstName(),
            'last_name' => Faker::lastName(),
            'mobile' => Faker::mobile(),
            'remember_token' => Str::random(10),
            'verification_code' => Str::random(10),
        ];
    }

    public function unverified(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return [
            ];
        });
    }
}
