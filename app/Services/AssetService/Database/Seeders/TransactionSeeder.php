<?php

namespace App\Services\AssetService\Database\Seeders;

use App\Services\AssetService\Models\Cart;
use App\Services\AssetService\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        Cart::get()->each(static function ($cart) {
            Transaction::factory()
                ->count(random_int(1, 3))
                ->create([
                    'cart_id' => $cart->id,
                ]);
        });
    }
}
