<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/tickets', 'TicketsController@index')->name('Tickets');
Route::get('/novo', 'NovoController@index')->name('Novo');

Route::get('/ticketsData','TicketsController@ticketsData');
Route::get('/ticketData/{id}', 'TicketsController@ticketData');
Route::get('/ticket/{id}', 'TicketsController@ticketView');

Route::post('/salvarTicket', 'NovoController@saveData');
