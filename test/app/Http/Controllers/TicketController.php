<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Repositories\ClientRepository;
use App\Repositories\OrderRepository;
use App\Repositories\TicketRepository;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tickets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required',
            'email_client' => 'required',
            'order_code' => 'required',
            'title' => 'required',
            'content' => 'required',
        ]);


        $client = (new ClientRepository());
        $client_id = $client->create(
            array('email' => $request->get('email_client')),
            array('name' => $request->get('name_client'))
        );

        $order = new OrderRepository;
        $order_id = $order->create(
            array('code' => $request->get('code'), 'client_id' => $client_id),
            array()
        );

        $ticket =  new TicketRepository;
        $created = $ticket->create(
            array('client_id' => $client_id, 'order_id' => $order_id),
            array('title' => $request->get('title'), 'content' => $request->get('content'))
        );

        if (!Ticket::createTicket($request))
            return redirect()->route('tickets.create')
                ->with('error', 'Código do pedido já cadatrado para outro cliente');

        return redirect()->route('ticket.store')
            ->with('success', 'Ticket created successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function report(Request $request)
    {
        $tickets = Ticket::latest()->paginate(5);

        return view('tickets.report', compact('tickets'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }
}