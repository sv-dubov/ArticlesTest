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
        Paginator::useBootstrap();

        view()->composer([
            'layouts.partials.lang-switcher',
            'front.partials._header',
            'admin.*',
        ], function ($view) {
            $view->with('languages', config('translatable.locales'));
        });
    }
}
