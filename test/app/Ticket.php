<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Client;

class Ticket extends Model
{
    protected $fillable = ['client_id', 'title', 'content', 'order_id'];

    public function search(array $filter, $totalPages)
    {
        $tickets = $this
            ->where(function ($query) use ($filter) {
                if (isset($filter['order_code']))
                    $query->where('code', $filter['order_code']);

                if (isset($filter['email']))
                    $query->where('email', $filter['email']);
            })
            ->orderBy('tickets.created_at', 'desc')
            ->paginate($totalPages);

        return $tickets;
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}