<?php

namespace App\Repositories;

use App\Models\ChallanIn;
use App\Repositories\Traits\CrudRepositoryTrait;

class ChallanInRepository
{
    use CrudRepositoryTrait;

    public $model;

    public function __construct(ChallanIn $model)
    {
        $this->model = $model;
    }

}
