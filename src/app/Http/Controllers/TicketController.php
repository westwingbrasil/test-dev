<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Order;
use App\Ticket;

class TicketController extends Controller
{
    public function index (Request $request) {
        $tickets = Ticket::join('customers', 'tickets.customer', 'customers.id')
        ->orderBy('tickets.created_at', 'ASC')
        ->paginate(5, ['tickets.id', 'customers.email', 'tickets.title', 'tickets.description', 'tickets.created_at', 'tickets.order']);
        
        if (!empty($request->query('email')) && empty($request->query('order'))) {
            $tickets = Ticket::join('customers', 'tickets.customer', 'customers.id')
            ->where('customers.email', 'like', '%' . $request->query('email') . '%')
            ->orderBy('tickets.created_at', 'ASC')
            ->paginate(5, ['tickets.id', 'customers.email', 'tickets.title', 'tickets.description', 'tickets.created_at', 'tickets.order']);
        }

        if (!empty($request->query('order')) && empty($request->query('email'))) {
            $tickets = Ticket::join('customers', 'tickets.customer', 'customers.id')
            ->where(['tickets.order' => $request->query('order')])
            ->orderBy('tickets.created_at', 'ASC')
            ->paginate(5, ['tickets.id', 'customers.email', 'tickets.title', 'tickets.description', 'tickets.created_at', 'tickets.order']);
        }

        if (!empty($request->query('order')) && !empty($request->query('email'))) {
            $tickets = Ticket::join('customers', 'tickets.customer', 'customers.id')
            ->where('customers.email', 'like', '%' . $request->query('email') . '%')
            ->where(['tickets.order' => $request->query('order')])
            ->orderBy('tickets.created_at', 'ASC')
            ->paginate(5, ['tickets.id', 'customers.email', 'tickets.title', 'tickets.description', 'tickets.created_at', 'tickets.order']);
        }

        $tickets->appends(request()->except('page'));

        return view('tickets', ['tickets' => $tickets]);
    }

    public function show ($id) {
        $ticket = Ticket::where('tickets.id', $id)
            ->join('customers', 'tickets.customer', 'customers.id')
            ->get(['tickets.id', 'customers.name', 'customers.email', 'tickets.title', 'tickets.description', 'tickets.created_at', 'tickets.order'])
            ->first();
        
        if (!$ticket) {
            return redirect('/tickets')->with('warning', 'Não existe um ticket com este ID. Por favor, selecione um ticket válido.');
        }

        return view('ticket', ['ticket' => $ticket]);
    }

    public function create () {
        return view('create');
    }
    
    public function store (Request $request) {
        $form = $request->post('ticket');

        $customer = Customer::firstOrNew(
            ['email' => $form['email']],
            ['name' => $form['name']]
        );
        
        $customer->save();

        $order = Order::where('id', $form['order'])->first();
        
        if (!$order) {
            $order = new Order;
            $order->customer = $customer['id'];
            $order->save();
        }
        
        if ($order->customer != $customer->id) {
            return redirect('/tickets/create')->with('warning', 'Este pedido não é seu. Insira um ticket para um pedido criado por você.');
        }
        
        $ticket = Ticket::where('order', $order->id)->first();
        
        if (!$ticket) {
            $ticket = new Ticket;
            $ticket->customer = $customer->id;
            $ticket->order = $order->id;
            $ticket->title = $form['title'];
            $ticket->description = $form['description'];
            $ticket->save();
            return redirect('/tickets/create')->with(['success' => 'Seu ticket foi criado com sucesso!', 'link' => "/tickets/{$ticket->id}"]);
        } else if ($ticket->customer != $customer->id) {
            return redirect('/tickets/create')->with('warning', 'Você não pode alterar um ticket que não é seu.');
        } else {
            $ticket->title = $form['title'];
            $ticket->description = $form['description'];
            $ticket->save();
            return redirect('/tickets/create')->with(['success' => 'Seu ticket foi atualizado com sucesso!', 'link' => "/tickets/{$ticket->id}"]);
        }
    }
}