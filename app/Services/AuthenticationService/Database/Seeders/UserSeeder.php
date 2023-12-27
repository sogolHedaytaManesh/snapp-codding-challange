<?php

namespace App\Services\AuthenticationService\Database\Seeders;

use App\Services\AssetService\Models\AccountNumber;
use App\Services\AssetService\Models\Cart;
use App\Services\AuthenticationService\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
	public function run(): void
	{
		User::factory()->count(10)->create();

		$this->makeCustomUserForTest();
	}


	private function makeCustomUserForTest(): void
	{
		$user = User::factory()
			->has(
				AccountNumber::factory([
					'balance' => 600000
				])
			)
			->create([
				'mobile' => '09127641597',
			]);

		$accountNumber = $user->accountNumbers()->first();

		Cart::create([
			'cart_number'       => 6362141122844054,
			'user_id'           => $user->id,
			'account_number_id' => $accountNumber->id
		]);

		Cart::create([
			'cart_number'       => 6219861050344604,
			'user_id'           => $user->id,
			'account_number_id' => $accountNumber->id
		]);
	}
}
