<?php

namespace Database\Seeders;

use App\Services\AssetService\Database\Seeders\AccountNumberSeeder;
use App\Services\AssetService\Database\Seeders\CartSeeder;
use App\Services\AssetService\Database\Seeders\TransactionSeeder;
use App\Services\AuthenticationService\Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AccountNumberSeeder::class,
            CartSeeder::class,
            TransactionSeeder::class,
        ]);
    }
}
