<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Traits\CrudRepositoryTrait;

class ProductRepository
{
    use CrudRepositoryTrait;

    public $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }
}
