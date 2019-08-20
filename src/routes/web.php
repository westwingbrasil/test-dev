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

Auth::routes();

Route::get('/', 'TicketController@index')->middleware('auth')->name('home');

Route::resource('ticket','TicketController')->middleware('auth');
Route::apiResource('ticket', 'TicketController');

