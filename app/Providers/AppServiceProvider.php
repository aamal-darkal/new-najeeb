<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Paginator::useBootstrap();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    //     Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) {
    //         echo "<pre>";
    //         print_r([ $query->sql, $query->bindings, $query->time]);
    //         echo "</pre>";
    //    });
    }
}
