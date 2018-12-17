<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $table = 'clients';

    protected $primaryKey = 'client_id';

    protected $fillable = [
        'client_name',
        'client_email',
        'client_status'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function ticket()
    {
        return $this->hasMany(Ticket::class, 'client_id');
    }
}
