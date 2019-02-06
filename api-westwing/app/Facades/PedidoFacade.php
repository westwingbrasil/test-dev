<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class PedidoFacade
 * @package App\Facades
 */
class PedidoFacade extends Facade
{
    /**
     * Return path from common interface
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Interfaces\PedidoInterface';
    }
}