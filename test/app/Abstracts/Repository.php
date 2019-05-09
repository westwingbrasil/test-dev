<?php namespace Acme\Abstracts;

use App\Repositories\RepositoryInterface;

abstract class Repository implements RepositoryInterface
{

    protected $modelClassName;

    public function create(array $filters, array $attributes)
    {
        if (empty($attributes))
            return call_user_func_array("{$this->modelClassName}::firstOrCreate", array($filters));
        else
            return call_user_func_array("{$this->modelClassName}::firstOrCreate", array($filters), array($attributes));
    }
}