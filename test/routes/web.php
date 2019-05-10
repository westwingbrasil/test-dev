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

//Route::resource('tickets', 'TicketController');
Route::any('tickets/report', 'TicketController@search')->name('tickets.report');
Route::any('tickets/create', 'TicketController@create')->name('tickets.create');
Route::any('tickets/index', 'TicketController@index')->name('tickets.index');
Route::any('tickets/store', 'TicketController@store')->name('tickets.store');
Route::any('tickets/show', 'TicketController@show')->name('tickets.show');