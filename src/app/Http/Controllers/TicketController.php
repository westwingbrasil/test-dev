<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Customer;
use App\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::with('order', 'order.customer')->orderBy('created_at', 'desc')->paginate(5);
        return view('ticket.index', compact('tickets'));
    }

    public function create()
    {
        return view('ticket.create');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);

        return view('ticket.show', compact('ticket'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        DB::beginTransaction();
        $message = '';
        $create_update = '';

        //Check if customer exists.
        $customer = Customer::where('email', '=', $request->input('customerEmail'))->first();


        if ($customer) {
            //If it does, get it's id.
            $customerId = $customer->id;
        } else {
            //If customer doesn't exists, create a new one.
            $customerId = Customer::add($request);
            $message .= "Customer";
        }

        //Check if order exists.
        $order = Order::where('number', '=', $request->input('orderNumber'))->first();

        if ($order) {
            //If it does, verify if this order belongs to this customer.
            if ($order->customerId == $customerId) {
                $orderId = $order->id;
            } else {
                //If it does not belongs, rollback DB transaction and returns error.
                DB::rollBack();
                return back()->with('error', 'Failed to create ticket. This order belongs to another customer.');
            }
        } else {
            //If it does not exists, create a new order.
            $orderData = [
                'number' => $request->input('orderNumber'),
                'customerId' => $customerId,
            ];
            $orderId = Order::add($orderData);

            if ($message != '') {
                $message .= ", ";
            }
            $message .= "Order";
        }


        //Set ticket data.
        $ticketData = [
            'orderId' => $orderId,
            'customerName' => $request->input('customerName'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message')

        ];

        //Check if ticket exists for this order.
        $ticket = Ticket::where('orderId', '=', $orderId)->first();

        if ($ticket) {
            $create_update = 'updated';
            Ticket::where('id', $ticket->id)->update($ticketData);
        } else {
            $create_update = 'created';
            $ticketId = Ticket::create($ticketData);
        }


        DB::commit();




        if ($message == '') {
            $message = "Ticket " . $create_update . " successfully!";
        } else {
            $message .= " and Ticket created successfully!";
        }
        return back()->with('success', $message);
    }


    public function filter(Request $request)
    {
        $filterData = $request;
        
            $tickets = Ticket::join('orders', 'orders.id', '=', 'tickets.orderId')
        ->join('customers', 'customers.id', '=', 'orders.customerId')
        
        ->where(function ($query) use ($request){
            if($request->input('customerEmail') != ''){
                $query->where('customers.email', $request->input('customerEmail'));
            }
            if($request->input('orderNumber') != ''){
                $query->where('orders.number', $request->input('orderNumber'));
            }

        })->orderBy('tickets.created_at', 'desc')->paginate(5);
        return view('ticket.index', compact('tickets', 'filterData'));
    }
}