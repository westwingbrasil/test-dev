<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Contracts\TicketsRepositoryContract', 'App\Repositories\TicketsRepository');
        $this->app->bind('App\Repositories\Contracts\ClientsRepositoryContract', 'App\Repositories\ClientsRepository');
        $this->app->bind('App\Repositories\Contracts\ReportsRepositoryContract', 'App\Repositories\ReportsRepository');
    }
}
