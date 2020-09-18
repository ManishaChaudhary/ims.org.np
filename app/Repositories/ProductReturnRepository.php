<?php

namespace App\Repositories;

use App\Models\ProductReturn;
use App\Repositories\Traits\CrudRepositoryTrait;

class ProductReturnRepository
{
    use CrudRepositoryTrait;

    public $model;

    public function __construct(ProductReturn $model)
    {
        $this->model = $model;
    }
}
