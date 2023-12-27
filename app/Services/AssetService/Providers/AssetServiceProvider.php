<?php

namespace App\Services\AssetService\Providers;

use App\Services\AssetService\Repository\AssetCacheServiceRepository;
use App\Services\AssetService\Repository\AssetDatabaseServiceRepository;
use App\Services\AssetService\Repository\Base\AssetServiceBaseInterface;
use App\Services\AssetService\Repository\Base\AssetServiceBaseRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;

class AssetServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AssetServiceBaseInterface::class, function (Application $app) {
            return new AssetServiceBaseRepository(
                new AssetDatabaseServiceRepository(),
                new AssetCacheServiceRepository()
            );
        });
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->mergeConfigFrom(__DIR__.'/../Configs/asset.php', 'asset');

        Factory::guessFactoryNamesUsing(static function (string $modelName) {
            return 'App\\Services\\AssetService\\Database\\Factories\\'.class_basename($modelName).'Factory';
        });
    }
}
