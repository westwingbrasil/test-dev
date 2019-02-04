<?php

namespace App\Repositories\Contracts;

interface TicketsRepositoryContract
{
    public function index();

    public function newTicket();

    public function store($request);

    public function details($ticket_id);

    public function updateForm($ticket_id);

    public function update($request, $ticket_id);

    public function delete($ticket_id);

    public function search($request);
}