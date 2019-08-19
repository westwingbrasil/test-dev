<?php

namespace App\Contracts;

interface CrudContract
{
    public function create($data);
    public function all($filters, $page = 1);
    public function find($id);
    public function update($id, $data);
    public function delete($id);
}