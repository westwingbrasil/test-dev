<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;

    protected $table = 'tickets';

    protected $primaryKey = 'ticket_id';

    protected $fillable = [
        'client_id',
        'ticket_title',
        'ticket_order',
        'ticket_content'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
