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

    /**
     * update.
     *
     * @param array
     */
    public function update(array $filters, array $attributes);
}