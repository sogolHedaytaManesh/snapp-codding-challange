<?php

namespace App\Services\ServiceManagement\Providers;

use App\Services\AssetService\Providers\AssetServiceProvider;
use App\Services\AuthenticationService\Providers\AuthenticationServiceProvider;
use App\Services\SmsService\Providers\SmsServiceProvider;
use Illuminate\Support\ServiceProvider;

class ServiceManagementProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(AuthenticationServiceProvider::class);
        $this->app->register(AssetServiceProvider::class);
        $this->app->register(SmsServiceProvider::class);
    }
}
