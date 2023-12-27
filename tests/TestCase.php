<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;
    use WithFaker;
    //
    //	protected function makeUser(int $times = 1): Factory
    //	{
    //		return $times > 1 ? User::factory($times) : User::factory();
    //	}
    //
    //	protected function makeAccountNumber(User $user, int $times = 1): Factory
    //	{
    //		$user = $user ?? $this->makeUser()->create();
    //
    //		$factory = AccountNumber::factory()->for($user);
    //
    //		return $times > 1 ? $factory->count($times) : $factory;
    //	}
    //
    //	protected function makeCart(User $user, AccountNumber $accountNumber, int $times = 1): Factory
    //	{
    //		$user = $user ?? $this->makeUser()->create();
    //		$accountNumber = $accountNumber ?? $this->makeAccountNumber()->create();
    //
    //		$factory = Cart::factory()
    //			->for($accountNumber)
    //			->for($user);
    //
    //		return $times > 1 ? $factory->count($times) : $factory;
    //	}
    //
    //	protected function makeTransaction(AccountNumber $accountNumber, int $times = 1): Factory
    //	{
    //		$accountNumber = $accountNumber ?? $this->makeAccountNumber()->create();
    //
    //		$factory = Transaction::factory()
    //			->for($accountNumber);
    //
    //		return $times > 1 ? $factory->count($times) : $factory;
    //	}
    //
    //	protected function makeWage(AccountNumber $accountNumber, Transaction $transaction, int $times = 1): Factory {
    //		$accountNumber = $accountNumber ?? $this->makeAccountNumber()->create();
    //		$transaction = $transaction ?? $this->makeTransaction()->create();
    //
    //		$factory = Wage::factory()
    //			->for($transaction)
    //			->for($accountNumber);
    //
    //		return $times > 1 ? $factory->count($times) : $factory;
    //	}
}
