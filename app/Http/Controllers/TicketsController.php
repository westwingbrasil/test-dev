<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\TicketsRepositoryContract;
use App\Http\Requests\TicketValidation;

class TicketsController extends Controller
{
    public function index(TicketsRepositoryContract $repositoryContract)
    {
        return $repositoryContract->index();
    }

    public function newTicket(TicketsRepositoryContract $repositoryContract)
    {
        return $repositoryContract->newTicket();
    }

    public function store(TicketsRepositoryContract $repositoryContract, TicketValidation $request)
    {
        return $repositoryContract->store($request);
    }

    public function details(TicketsRepositoryContract $repositoryContract, $id)
    {
        return $repositoryContract->details($id);
    }

    public function updateForm(TicketsRepositoryContract $repositoryContract, $id)
    {
        return $repositoryContract->updateForm($id);
    }

    public function update(TicketsRepositoryContract $repositoryContract, TicketValidation $request, $id)
    {
        return $repositoryContract->update($request, $id);
    }

    public function delete(TicketsRepositoryContract $repositoryContract, $id)
    {
        return $repositoryContract->delete($id);
    }

    public function search(TicketsRepositoryContract $repositoryContract, Request $request)
    {
        return $repositoryContract->search($request);
    }
}
