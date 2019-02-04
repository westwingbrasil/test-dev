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
    return view('index');
});

Route::get('ticket', 'TicketController@create')->name('ticket.create');
Route::post('ticket', 'TicketController@store')->name('ticket.store');
Route::get('users', 'UserController@index');
Route::post('users', 'UserController@create');