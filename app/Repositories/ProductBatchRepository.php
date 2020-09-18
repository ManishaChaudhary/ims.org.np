<?php

namespace App\Repositories;

use App\Models\ProductBatch;
use App\Repositories\Traits\CrudRepositoryTrait;

class ProductBatchRepository
{
    use CrudRepositoryTrait;

    public $model;

    public function __construct(ProductBatch $model)
    {
        $this->model = $model;
    }
}
