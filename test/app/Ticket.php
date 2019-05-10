<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['client_id', 'title', 'content', 'order_id'];

    public function search(array $filter, $totalPages)
    {
        $tickets = $this
            ->join('clients', 'tickets.client_id', '=', 'clients.id')
            ->join('orders', 'tickets.order_id', '=', 'orders.id')
            ->where(function ($query) use ($filter) {
                if (isset($filter['order_code']))
                    $query->where('code', $filter['order_code']);

                if (isset($filter['email']))
                    $query->where('email', $filter['email']);
            })->paginate($totalPages);
        return $tickets;
    }
}