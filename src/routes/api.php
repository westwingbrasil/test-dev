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
Route::prefix('ticket')->group(function() {
    Route::get('{id}', 'TicketController@showTicket');
    Route::get('', 'TicketController@showTickets');
    Route::post('', 'TicketController@createTicket');
});
