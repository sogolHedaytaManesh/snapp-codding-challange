<?php

namespace App\Services\SmsService\Providers;

use App\Services\SmsService\Repository\SmsServiceInterface;
use App\Services\SmsService\Repository\SmsServiceRepository;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(SmsServiceInterface::class, SmsServiceRepository::class);
    }

    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../Configs/sms.php', 'sms');
    }
}
