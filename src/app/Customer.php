<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'name', 
        'email'
    ];
    protected $guarded = [
        'id'
    ];

    public function order(){
        return $this->hasMany(Order::class);
    }
}
