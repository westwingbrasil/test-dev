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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'clients', 'middleware' => 'auth'], function () {
    Route::get('/', 'ClientsController@index');
    Route::get('/new', 'ClientsController@newClient');
    Route::post('/store', 'ClientsController@store');
    Route::get('/details/{id}', 'ClientsController@details');

    Route::get('/update/{id}', 'ClientsController@updateForm');
    Route::post('/update/{id}', 'ClientsController@update');

    Route::get('/delete/{id}', 'ClientsController@delete');

    Route::get('/search', 'ClientsController@search');

    Route::get('/report', 'ReportsController@clients');
});

Route::group(['prefix' => 'tickets', 'middleware' => 'auth'], function () {
    Route::get('/', 'TicketsController@index');
    Route::get('/new', 'TicketsController@newTicket');
    Route::post('/store', 'TicketsController@store');
    Route::get('/details/{id}', 'TicketsController@details');

    Route::get('/update/{id}', 'TicketsController@updateForm');
    Route::post('/update/{id}', 'TicketsController@update');

    Route::get('/delete/{id}', 'TicketsController@delete');

    Route::get('/search', 'TicketsController@search');
});