<?php

namespace App\Repositories;

//use \Illuminate\Http\Request;

interface CreateRepositoryInterface
{
    /**
     * Save.
     *
     * @param array
     */
    public function create(\Illuminate\Http\Request $request): int;
}