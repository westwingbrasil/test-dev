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

Route::redirect('/', '/tickets');

Route::any('tickets/report', 'TicketController@search')->name('tickets.report');
Route::any('tickets/create', 'TicketController@create')->name('tickets.create');
Route::any('tickets', 'TicketController@index')->name('tickets.index');
Route::any('tickets/store', 'TicketController@store')->name('tickets.store');
Route::get('tickets/show/{id}', 'TicketController@show')->name('tickets.show');