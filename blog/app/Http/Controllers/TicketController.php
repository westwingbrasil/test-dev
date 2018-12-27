<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TicketController extends Controller
{
    public function create() {
        return view('ticket');
    }

    public function store(Request $request) {
        $ticket = [];
        $ticket['name'] = $request->get('name');
        $ticket['email'] = $request->get('email');
        $ticket['ticketTitle'] = $request->get('ticketTitle');
        $ticket['ticketDescription'] = $request->get('ticketDescription');
        $ticket['orderNumber'] = $request->get('orderNumber');
    
        // Mail delivery logic goes here
    
        //flash('Your message has been sent!')->success();
    
        return redirect()->route('ticket.create');
    }
}
