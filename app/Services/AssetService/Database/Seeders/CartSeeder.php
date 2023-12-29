<?php

namespace App\Services\AssetService\Database\Seeders;

use App\Services\AssetService\Models\AccountNumber;
use App\Services\AssetService\Models\Cart;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        AccountNumber::get()->each(static function ($accountNumber) {
            Cart::factory()
                ->count(random_int(1, 3))
                ->create([
                    'account_number_id' => $accountNumber->id,
                ]);
        });
    }
}
