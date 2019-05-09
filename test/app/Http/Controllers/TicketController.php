<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Repositories\TicketRepository;
use App\Repositories\ClientRepository;
use App\Repositories\OrderRepository;

class TicketController extends Controller
{
    protected $ticket;

    public function __construct(TicketRepository $ticket)
    {
        $this->ticket = $ticket;
    }


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
     * @param  \App\Repositories\TicketRepository  $ticket
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

        $client =  new ClientRepository;
        $ticket =  new TicketRepository;
        $order =  new OrderRepository;

        $ticket->create($client, $order, $request);

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