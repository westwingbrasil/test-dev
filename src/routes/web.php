<?php

Route::get('/', function () {
    return view('index');
});

Route::get('/create', function () {
    return view('create');
});

Route::get('/tickets', 'TicketController@index');

Route::get('/tickets/create', 'TicketController@create');

Route::post('/tickets/create', 'TicketController@store');

Route::get('/tickets/{id}', 'TicketController@show');