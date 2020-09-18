<?php

namespace App\Repositories;

use App\Models\Godown;
use App\Repositories\Traits\CrudRepositoryTrait;

class GodownRepository
{
    use CrudRepositoryTrait;

    public $model;

    public function __construct(Godown $model)
    {
        $this->model = $model;
    }
}
