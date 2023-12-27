<?php

namespace App\Services\AssetService\Providers;

use App\Services\AssetService\Events\AssetCacheDataEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class AssetEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        AssetCacheDataEvent::class,
    ];
}
