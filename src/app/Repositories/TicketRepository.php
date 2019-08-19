<?php

namespace App\Repositories;

use App\Contracts\TicketRepositoryContract;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Order;

class TicketRepository extends EloquentRepository implements TicketRepositoryContract
{
    protected function getModel(): string
    {
        return Ticket::class;
    }

    public function create($data)
    {
        // Caso as entidades desse sub domínio fiquem complexas, podemos criar um repositório similar a esse,
        // por hora, não há a menor necessidade disso.
        $user = $this->getUser($data['user']);
        // O mesmo se aplica para pedidos
        $order = $this->getOrder($data['orderId'], $user);
        // Atributos de pesquisa e adição
        $ticketAttributes = [
            'user_id' => $user->id,
            'order_id' => $data['orderId']
        ];
        $ticket = $this->getModel()::firstOrNew($ticketAttributes, $ticketAttributes);
        $ticket->title = $data['title'];
        $ticket->content = $data['content'];
        $ticket->save();

        return $ticket;
    }

    private function getUser($data)
    {
        return User::firstOrCreate([
            'email' => $data['email']
        ], [
            'email' => $data['email'],
            'name' => $data['name']
        ]);
    }

    private function getOrder($id, $user)
    {
        $order = Order::firstOrNew([
            'id' => $id,
        ],[
            'user_id' => $user->id
        ]);

        if ($order->id && $order->user_id !== $user->id) {
            throw new \DomainException('That Order is not yours');
        } else {
            $order->id = $id;
            $order->save();
        }

        return $order;
    }

    public function all($filters, $page = 1)
    {
        $query = $this->getModel()::query()->join('user', 'user.id', '=', 'ticket.user_id');

        if (array_key_exists("email", $filters)) {
            $query = $query->where(['user.email' => $filters['userEmail']]);
        }
        if (array_key_exists("orderId", $filters)) {
            $query = $query->where(['order_id' => $filters['orderId']]);
        }

        return $query->paginate(5, [
            'ticket.id',
            'order_id',
            'title',
            'user.email',
            'ticket.created_at'
        ], 'page', $page);
    }

    public function find($id)
    {
        return $this->getModel()::query()
            ->where('id', $id)
            ->join('user', 'user.id', '=', 'ticket.user_id')
            ->get();

    }

}