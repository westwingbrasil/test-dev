<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClientValidation;
use App\Repositories\Contracts\ClientsRepositoryContract;

class ClientsController extends Controller
{
    public function index(ClientsRepositoryContract $repositoryContract)
    {
        return $repositoryContract->index();
    }

    public function newClient(ClientsRepositoryContract $repositoryContract)
    {
        return $repositoryContract->newClient();
    }

    public function store(ClientsRepositoryContract $repositoryContract, ClientValidation $request)
    {
        return $repositoryContract->store($request);
    }

    public function details(ClientsRepositoryContract $repositoryContract, $id)
    {
        return $repositoryContract->details($id);
    }

    public function updateForm(ClientsRepositoryContract $repositoryContract, $id)
    {
        return $repositoryContract->updateForm($id);
    }

    public function update(ClientsRepositoryContract $repositoryContract, ClientValidation $request, $id)
    {
        return $repositoryContract->update($request, $id);
    }

    public function delete(ClientsRepositoryContract $repositoryContract, $id)
    {
        return $repositoryContract->delete($id);
    }

    public function search(ClientsRepositoryContract $repositoryContract, Request $request)
    {
        return $repositoryContract->search($request);
    }
}
