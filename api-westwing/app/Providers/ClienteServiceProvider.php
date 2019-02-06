<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ClienteServiceProvider extends ServiceProvider
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
        $this->app->singleton(
            'App\Interfaces\ClienteInterface',
            'App\WestCliente'
        );
    }
}
