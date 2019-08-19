<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    protected $table = 'tickets';
    protected $fillable = [
        'orderId', 
        'customerName', 
        'subject', 
        'message'
    ];
    protected $guarded = [
        'id',
        'createDate'
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }

}
