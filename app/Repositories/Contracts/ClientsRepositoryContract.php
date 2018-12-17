<?php

namespace App\Repositories\Contracts;

interface ClientsRepositoryContract
{
    public function index();

    public function newClient();

    public function store($request);

    public function details($client_id);

    public function updateForm($client_id);

    public function update($request, $client_id);

    public function delete($client_id);

    public function search($request);
}