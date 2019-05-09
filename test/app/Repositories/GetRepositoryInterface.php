<?php

namespace App\Repositories;

interface GetRepositoryInterface
{
    /**
     * Get by ID
     *
     * @param int
     */
    public function get($id);

    /**
     * Get all.
     *
     * @return mixed
     */
    public function all();
}