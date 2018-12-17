<?php

namespace App\Repositories;

use App\Models\Ticket;
use App\Models\Client;
use App\Repositories\Contracts\TicketsRepositoryContract;

class TicketsRepository implements TicketsRepositoryContract
{
    protected $ticket;
    protected $client;

    public function __construct(Ticket $ticket, Client $client)
    {
        $this->ticket = $ticket;
        $this->client = $client;
    }

    public function index()
    {
        $ticketsByClient = $this->ticket
            ->with('client')
            ->paginate(5);

        return view('tickets.index', ['tickets' => $ticketsByClient]);
    }

    public function newTicket()
    {
        $clients = $this->client->all();

        return view('tickets.new', ['clients' => $clients]);
    }

    public function store($request)
    {
        $data = $request->all();

        $createTicket = $this->ticket->create($data);

        if ($createTicket) {
            session()->flash('message', 'Ticket criado com sucesso');
            return redirect()->back();
        }

        session()->flash('message', 'Ops algo deu errado');
        return redirect()->back();
    }

    public function details($ticket_id)
    {
        $ticket = $this->ticket
            ->with('client')
            ->where('ticket_id', $ticket_id)
            ->paginate(5);

        return view('tickets.details', ['ticket' => $ticket]);
    }

    public function updateForm($ticket_id)
    {
        return view('tickets.update', ['ticket' => $this->ticket->find($ticket_id)]);
    }

    public function update($request, $ticket_id)
    {
        $ticket = $this->ticket->find($ticket_id);

        if ($ticket) {
            $data = $request->all();
            $ticket->update($data);

            session()->flash('message', 'Ticket atualizado com sucesso');
            return redirect()->back();
        }

        session()->flash('message', 'Ops algo deu errado');
        return redirect()->back();
    }

    public function delete($ticket_id)
    {
        $ticket = $this->ticket->find($ticket_id);

        if ($ticket) {
            $ticket->delete();
            session()->flash('message', 'Ticket excluído com sucesso');
            return redirect()->back();
        }
        session()->flash('message', 'Ops algo deu errado');
        return redirect()->back();
    }

    public function search($request)
    {
        $tickets = $this->ticket
            ->with('client')
            ->whereHas('client', function ($query) use($request) {
                $query->where('client_email', 'like', "%{$request->input('search')}%");
                $query->orWhere('client_name', 'like', "%{$request->input('search')}%");
                $query->orWhere('ticket_order', 'like', "%{$request->input('search')}%");
                $query->orWhere('ticket_title', 'like', "%{$request->input('search')}%");
            })->paginate(5);

        return view('tickets.index', ['tickets' => $tickets]);
    }
}