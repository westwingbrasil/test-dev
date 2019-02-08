<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class TicketFacade
 * @package App\Facades
 */
class TicketFacade extends Facade
{
    /**
     * Return path from common interface
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Interfaces\TicketInterface';
    }
}