<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Tailwind
        // Paginator::defaultView('view-name');

        // Paginator::defaultSimpleView('view-name');

        // Bootstrap
        // Paginator::useBootstrapFive();
        // Paginator::useBootstrapFour();
    }
}
