<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'customer',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}