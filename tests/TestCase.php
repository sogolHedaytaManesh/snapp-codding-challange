<?php

namespace Tests;

use App\Services\AssetService\Models\AccountNumber;
use App\Services\AssetService\Models\Cart;
use App\Services\AssetService\Models\Transaction;
use App\Services\AssetService\Models\Wage;
use App\Services\AuthenticationService\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;
    use WithFaker;

    protected function makeUser(int $times = 1): Factory
    {
        return $times > 1 ? User::factory($times) : User::factory();
    }

    protected function makeAccountNumber(User $user, int $times = 1): Factory
    {
        $user = $user ?? $this->makeUser()->create();

        $factory = AccountNumber::factory()->for($user);

        return $times > 1 ? $factory->count($times) : $factory;
    }

    protected function makeCartNumber(User $user, AccountNumber $accountNumber, int $times = 1): Factory
    {
        $user = $user ?? $this->makeUser()->create();

        $factory = Cart::factory()->for($user);

        return $times > 1 ? $factory->count($times) : $factory;
    }

    protected function makeTransaction(Cart $cartNumber, int $times = 1): Factory
    {
        $cartNumber = $cartNumber ?? $this->makeCartNumber()->create();

        $factory = Transaction::factory()
            ->for($cartNumber);

        return $times > 1 ? $factory->count($times) : $factory;
    }

    protected function makeWage(AccountNumber $accountNumber, Transaction $transaction, int $times = 1): Factory
    {
        $accountNumber = $accountNumber ?? $this->makeAccountNumber()->create();
        $transaction = $transaction ?? $this->makeTransaction()->create();

        $factory = Wage::factory()
            ->for($transaction)
            ->for($accountNumber);

        return $times > 1 ? $factory->count($times) : $factory;
    }
}
