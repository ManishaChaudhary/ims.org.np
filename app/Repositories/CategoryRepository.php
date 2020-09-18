<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Traits\CrudRepositoryTrait;

class CategoryRepository
{
    use CrudRepositoryTrait;

    public $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }
}
