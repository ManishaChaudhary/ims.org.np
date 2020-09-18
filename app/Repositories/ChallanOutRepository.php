<?php

namespace App\Repositories;

use App\Models\ChallanOut;
use App\Repositories\Traits\CrudRepositoryTrait;

class ChallanOutRepository
{
    use CrudRepositoryTrait;

    public $model;

    public function __construct(ChallanOut $model)
    {
        $this->model = $model;
    }

}
