<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    private string $modelClass;
    private Builder $query;

    public function __construct(string $modelClass)
    {
        $this->modelClass = $modelClass;
        $this->query = $modelClass::query();
    }

    public function getAll(): array
    {
        return $this->query->get()->all();
    }

    public function getFirstBy(array $conditions): ?Model
    {
        $res = $this->getBy($conditions)->first();
        /**
         * somehow element queried by where->first would disappear from where->all request
         * to same query, so need to update this->query :))
         */
        $this->query = $this->modelClass::query();
        return $res;
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
