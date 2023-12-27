<?php

namespace App\Services\AssetService\Database\Seeders;

use App\Services\AssetService\Models\AccountNumber;
use App\Services\AssetService\Models\Cart;
use App\Services\AuthenticationService\Models\User;
use Illuminate\Database\Seeder;

class AccountNumberSeeder extends Seeder
{
    public function run(): void
    {
        $AccountNumbers = AccountNumber::select('id', 'user_id')->get();
        if ($AccountNumbers->count() === 0) {
            User::query()->each(function ($user) {
                AccountNumber::factory()
                    ->count(random_int(2, 3))
                    ->for($user)
                    ->create();
            });
        }
    }
}
