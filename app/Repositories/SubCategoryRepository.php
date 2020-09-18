<?php

namespace App\Repositories;

use App\Repositories\Traits\CrudRepositoryTrait;
use App\Models\SubCategory;

class SubCategoryRepository
{
    use CrudRepositoryTrait;

    public $model;

    public function __construct(SubCategory $model)
    {
        $this->model = $model;
    }
}
