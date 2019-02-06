<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class ClienteFacade
 * @package App\Facades
 */
class ClienteFacade extends Facade
{
    /**
     * Return path from common interface
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Interfaces\ClienteInterface';
    }
}