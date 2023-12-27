<?php

namespace App\Services\AuthenticationService\Providers;

use App\Services\AuthenticationService\Repository\AuthenticationServiceInterface;
use App\Services\AuthenticationService\Repository\AuthenticationServiceRepository;
use Illuminate\Support\ServiceProvider;

class AuthenticationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AuthenticationServiceInterface::class, AuthenticationServiceRepository::class);
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }
}
