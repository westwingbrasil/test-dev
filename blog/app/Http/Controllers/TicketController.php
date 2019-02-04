<?php
namespace App\Http\Controllers;

use App\Http\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
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

        $user = User::firstOrNew(['email' => $request->get('email')]);
        $user->name = 'john';
        $user->email = $request->get('email');
        $user->save();
        flash(User::all())->success();
    
        flash('Your message has been sent!')->success();
    
       return redirect()->route('ticket.create');
    }
}
