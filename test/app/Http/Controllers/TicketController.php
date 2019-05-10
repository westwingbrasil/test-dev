<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Repositories\RepositoryInterface;

class TicketController extends Controller
{
    protected $repo;

    public function __construct(RepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::orderBy('tickets.created_at', 'desc')
            ->join('clients', 'tickets.client_id', '=', 'clients.id')
            ->join('orders', 'tickets.order_id', '=', 'orders.id')
            ->paginate(5);

        return view('tickets.index', compact('tickets'))
            ->with('i', (request()->input(
                'page',
                1
            ) - 1) * 5);
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


        $this->repo->setModelClassName('App\\Client');
        $client = $this->repo->create(
            ['email' => $request->get('email_client')],
            ['name' => $request->get('name_client')]
        );

        $this->repo->setModelClassName('App\\Order');
        $order = $this->repo->create(
            array('code' => $request->get('code'), 'client_id' => $client->id),
            array()
        );

        //Validation - if have ticket with same order code to outher client
        // if (!Ticket::createTicket($request)) {
        //     return redirect()->route('tickets.create')
        //         ->with('error', 'Código do pedido já cadatrado para outro cliente');
        // }

        $this->repo->setModelClassName('App\\Ticket');
        $this->repo->update(
            array('client_id' => $client->id, 'order_id' => $order->id),
            array('title' => $request->get('title'), 'content' => $request->get('content'))
        );


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