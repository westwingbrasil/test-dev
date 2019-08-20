<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTicketRequest;
use App\Contracts\TicketRepositoryContract as TicketRepository;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function createTicket(CreateTicketRequest $request, TicketRepository $ticketRepo)
    {
        try {
            return $ticketRepo->create($request->validated());
        } catch (\DomainException $e) {
            return response([
                "message" => $e->getMessage(),
                "errors" => [
                    "orderId" => [$e->getMessage()]
                ]
            ],422);
        }
    }

    public function showTickets(TicketRepository $ticketRepo, Request $request)
    {
        $page = $request->has(['page']) ? $request->only(['page'])['page'] : 1;

        return $ticketRepo->all($request->only(['userEmail', 'orderId']), $page);
    }

    public function showTicket($id, TicketRepository $ticketRepo)
    {
        return $ticketRepo->find($id);
    }
}
