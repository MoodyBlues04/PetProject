<?php

namespace App\Repository;

use App\Models\Store;

class StoreRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(Store::class);
    }
}
