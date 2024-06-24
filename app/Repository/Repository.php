<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    private Builder $query;

    public function __construct(string|Model|Builder $query)
    {
        if (!is_string($query) && is_subclass_of($query, Model::class)) {
            $query = $query::class;
        }
        if (is_string($query)) {
            $query = $query::query();
        }
        $this->query = $query;
    }

    public function getAll(): array
    {
        return $this->query->get()->all();
    }

    public function getFirstBy(array $conditions): ?Model
    {
        return $this->getBy($conditions)->first();
    }

    public function getAllBy(array $conditions): array
    {
        return $this->getBy($conditions)->get()->all();
    }

    public function getBy(array $conditions): ?Builder
    {
        return $this->query->where($conditions);
    }

    public function create(array $properties): ?Model
    {
        return $this->query->create($properties);
    }
}
