<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;
use App\Client;
use App\Order;
use App\Ticket;

class PostRepository implements RepositoryInterface
{
    protected $modelClassName;

    public function setModelClassName($className)
    {
        $this->modelClassName = $className;
    }

    public function create(array $filters, array $attributes): int
    {
        if (empty($attributes)) {
            $result = call_user_func_array("{$this->modelClassName}::firstOrCreate", array($filters));
        } else {
            $result = call_user_func_array("{$this->modelClassName}::firstOrCreate", array($filters, $attributes));
        }
        return $result->id;
    }

    public function update(array $filters, array $attributes)
    {
        call_user_func_array("{$this->modelClassName}::updateOrCreate", array($filters), array($attributes));
    }
}