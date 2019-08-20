<?php

namespace App\Http\Controllers;

use App\Client;
use App\Ticket;
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
        $tickets = Ticket::query();

        $tickets->when(!empty(request('code')), function($query) {
            return $query->where('code', request('code'));
        });

        $tickets->when(!empty(request('email')), function($query) {
            return $query->whereHas('client', function ($query) {
                $query->where('email', 'LIKE', '%' . request('email') . '%');
            });
        });

        return view('ticket.index', [
            'tickets' => $tickets->with('client')->orderBy('id', 'desc')->paginate(5),
            'code' => request('code'),
            'email' => request('email')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            //Identifica o Cliente pelo e-mail preenchido
            if ( ! $client = Client::where('email', '=', $request->get('email'))->first() ) {
                //Cadastra um novo cliente
                $client = new Client([
                    'name' => $request->get('name'),
                    'email' => $request->get('email')
                ]);

                $client->save();
            } else {
                //Atualiza o cliente
                $client->name = $request->get('name');
                $client->save();
            }

            //Verificando se o Ticket já existe
            if ( $ticket = Ticket::where('code', '=', $request->get('code'))->first() ) {

                //Verificando se o Ticket já foi cadastrado para outro Cliente
                if ( $ticket['client_id'] !== $client['id'] ) {
                    return redirect()->back()->withErrors(['Essse Ticket já foi cadastrado para outro Cliente']);
                }

                $ticket->title = $request->get('title');
                $ticket->content = $request->get('content');

                $ticket->save();

                return redirect()->back()->with('success', 'Ticket atualizado com sucesso!');
            }

            //Criando novo Ticket
            $ticket = new Ticket([
                'code' => $request->get('code'),
                'title' => $request->get('title'),
                'content' => $request->get('content')
            ]);

            $client->tickets()->save($ticket);

            return redirect()->back()->with('success', 'Ticket cadastrado com sucesso!');

        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $ticket = Ticket::find($id);

            return view('ticket.show', [
                'ticket' => $ticket
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $ticket = Ticket::find($id);
            $client = Client::find($ticket['client_id']);

            return view('ticket.create', [
                'ticket' => $ticket,
                'client' => $client
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if ( Ticket::find($id) ) {
                $ticket = Ticket::find($id);
                $ticket->delete();
            }
            return redirect()->back()
                ->with('success', 'Ticket removido com sucesso!');
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
