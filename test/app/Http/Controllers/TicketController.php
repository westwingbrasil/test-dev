<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Order;
use App\Repositories\RepositoryInterface;

class TicketController extends Controller
{
    protected $repo;
    public $totalPage = 5;

    public function __construct(RepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Ticket $ticket)
    {
        $tickets = $ticket->all();

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Report tickets.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request, Ticket $ticket)
    {
        $params = $request->except('_token');

        $tickets = $ticket->search($params, $this->totalPage);

        return view('tickets.search', compact('tickets', 'params'));
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
            'client_email' => 'required',
            'order_code' => 'required',
            'title' => 'required',
            'content' => 'required',
        ]);


        $this->repo->setModelClassName('App\\Client');
        $client_id = $this->repo->create(
            ['email' => $request->get('client_email')],
            ['name' => $request->get('client_name')]
        );

        //Validation - if have ticket with same order code to outher client
        $count = Order::where('code',  $request->get('order_code'))->where('client_id', '<>', $client_id)->count();

        if ($count != 0) {
            return redirect()->route('tickets.create')
                ->with('error', 'Código do pedido já cadatrado para outro cliente');
        }

        $this->repo->setModelClassName('App\\Order');
        $order_id = $this->repo->create(
            array('code' => $request->get('order_code'), 'client_id' => $client_id),
            array()
        );

        $this->repo->setModelClassName('App\\Ticket');
        $this->repo->update(
            array('client_id' => $client_id, 'order_id' => $order_id),
            array('title' => $request->get('title'), 'content' => $request->get('content'))
        );


        return redirect()->route('tickets.create')
            ->with('success', 'Ticket criado com sucesso.');
    }

    /**
     * Show Ticket
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);
        return view('tickets.show', compact('ticket'));
    }
}