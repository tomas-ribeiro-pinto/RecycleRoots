<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Jetstream::ignoreRoutes();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
