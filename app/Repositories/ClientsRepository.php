<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Contracts\ClientsRepositoryContract;

class ClientsRepository implements ClientsRepositoryContract
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function index()
    {
        $clients = $this->client
            ->paginate(5);

        return view('clients.index', ['clients' => $clients]);
    }

    public function newClient()
    {
        return view('clients.new');
    }

    public function store($request)
    {
        $data = $request->all();

        $createClient = $this->client->create($data);

        if ($createClient) {
            session()->flash('message', 'Cliente cadastrado com sucesso');
            return redirect()->back();
        }

        session()->flash('message', 'Ops algo deu errado');
        return redirect()->back();
    }

    public function details($client_id)
    {
        $client = $this->client->find($client_id);

        return view('clients.details', ['client' => $client]);
    }

    public function updateForm($client_id)
    {
        return view('clients.update', ['client' => $this->client->find($client_id)]);
    }

    public function update($request, $client_id)
    {
        $client = $this->client->find($client_id);

        if ($client) {
            $data = $request->all();
            $client->update($data);

            session()->flash('message', 'Cliente atualizado com sucesso');
            return redirect()->back();
        }

        session()->flash('message', 'Ops algo deu errado');
        return redirect()->back();
    }

    public function delete($client_id)
    {
        $client = $this->client->find($client_id);

        if ($client) {
            $client->delete();
            session()->flash('message', 'Cliente excluído com sucesso');
            return redirect()->back();
        }
        session()->flash('message', 'Ops algo deu errado');
        return redirect()->back();
    }

    public function search($request)
    {
        $clients = $this->client
            ->where('client_name', 'like', "%{$request->input('search')}%")
            ->orWhere('client_email', 'like', "%{$request->input('search')}%")
            ->orWhere('client_status', 'like', "%{$request->input('search')}%")
            ->paginate(5);

        return view('clients.index', ['clients' => $clients]);
    }
}