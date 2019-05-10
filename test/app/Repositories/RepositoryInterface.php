<?php

namespace App\Repositories;

interface RepositoryInterface
{
    /**
     * Set model name.
     *
     * @param array
     */
    public function setModelClassName($className);

    /**
     * Save.
     *
     * @param array
     */
    public function create(array $filters, array $attributes): int;

    /**
     * update.
     *
     * @param array
     */
    public function update(array $filters, array $attributes);
}