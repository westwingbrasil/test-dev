<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $fillable = [
        'order',
        'customer',
        'title',
        'description'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:00',
    ];
}
