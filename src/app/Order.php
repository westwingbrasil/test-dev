<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'customerId',
        'number'
    ];
    protected $guarded = [
        'id'
    ];

    public static function add($data){
        
        $query = Order::create($data);
		return $query->id;
    }

    public function tickets(){
        return $this->hasMany('App\Ticket', 'id', 'orderId');
    }
    
    public function customer(){
        return $this->belongsTo('App\Customer', 'customerId');
    }
}
