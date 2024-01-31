<?php

namespace App\Providers;

use App\PSGC\GeographicCacheService;
use App\PSGC\GeographicContract;
use App\PSGC\GeographicService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(GeographicContract::class, function ($app) {
            return new GeographicCacheService(
                new GeographicService
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
