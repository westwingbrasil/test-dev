<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'customerId'
    ];
    protected $guarded = [
        'id'
    ];

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
    
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
