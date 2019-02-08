<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
    /*
    |--------------------------------------------------------------------------
    | Cliente Routes
    |--------------------------------------------------------------------------
    */
    Route::get('getClients', 'ClienteController@getClients');
    Route::get('getClient', 'ClienteController@getClientById');
    Route::post('storeClient', 'ClienteController@storeClient');
    Route::post('updateClient', 'ClienteController@updateClient');
    Route::delete('destroyClient', 'ClienteController@destroyClient');
    /*
    |--------------------------------------------------------------------------
    | Ticket Routes
    |--------------------------------------------------------------------------
    */
    Route::get('getTickets', 'TicketController@getTickets');
    Route::get('getTicket', 'TicketController@getTicketById');
    Route::get('getFilteredData', 'TicketController@getFilteredData');
    Route::get('storeTicket', 'TicketController@storeTicket');
    Route::post('updateTicket', 'TicketController@updateTicket');
    Route::delete('destroyTicket', 'TicketController@destroyTicket');
    /*
    |--------------------------------------------------------------------------
    | Pedido Routes
    |--------------------------------------------------------------------------
    */
    Route::get('getPedidos', 'PedidoController@getPedidos');
    Route::get('getPedido', 'PedidoController@getPedidoById');
    Route::post('storePedido', 'PedidoController@storePedido');
    Route::post('updatePedido', 'PedidoController@updatePedido');
    Route::delete('destroyPedido', 'PedidoController@destroyPedido');