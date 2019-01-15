<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('tickets');
    }

    /**
     * Return the data for the given ticket.
     *
     * @param  int  $id
     * @param  boolean  $view
     * @return \Illuminate\Contracts\Support\Renderable OR Response
     */
    private function ticket($id, $view)
    {
        if ($view) {
            $ret = view('ticket', array('id' => $id));
        } else {
            $ticket = DB::table('tickets')
                ->join('clients', 'client_id', '=', 'clients.id')
                ->join('orders', 'order_id', '=', 'orders.id')
                ->select('tickets.*', 'orders.o_title', 'clients.name')
                ->where('tickets.id', '=', $id)
                ->get();
            $ret = array('ticket' => $ticket);
        }

        return $ret;
    }

    /**
     * Show a list of all of the application's tickets.
     *
     * @return Response
     */
    public function ticketsData()
    {
        $tickets = DB::table('tickets')
            ->join('clients', 'client_id', '=', 'clients.id')
            ->join('orders', 'order_id', '=', 'orders.id')
            ->select('tickets.*', 'orders.o_title', 'clients.email')
            ->get();

        return array('tickets' => $tickets);
    }

    /**
     * Show the data for the given ticket.
     *
     * @param  int  $id
     * @return Response
     */
    public function ticketData($id)
    {
        return $this->ticket($id, false);
    }

    /**
     * Show the dashboard for the given ticket.
     *
     * @param  int  $id
     * @return Response
     */
    public function ticketView($id)
    {
        return $this->ticket($id, true);
    }
}
