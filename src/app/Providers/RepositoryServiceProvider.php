<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public $bindings = [
        'App\\Contracts\\TicketRepositoryContract' => 'App\\Repositories\\TicketRepository'
    ];
}