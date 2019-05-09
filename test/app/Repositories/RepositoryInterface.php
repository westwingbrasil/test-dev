<?php

namespace App\Repositories;

interface RepositoryInterface
{
    /**
     * Save.
     *
     * @param array
     */
    public function create(array $filters, array $attributes);
}