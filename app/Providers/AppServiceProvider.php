<?php

namespace App\Providers;

use App\Models\User;
use App\PSGC\GeographicCacheService;
use App\PSGC\GeographicContract;
use App\PSGC\GeographicService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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

        Gate::define('viewPulse', function (User $user) {
            return true;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->environment('local')) {
            DB::listen(function ($query) {
                logger(Str::replaceArray('?', $query->bindings, $query->sql));
            });
        }
    }
}
