<?php

namespace App\Repositories;

use App\Models\Company;
use App\Repositories\Traits\CrudRepositoryTrait;

class CompanyRepository
{
    use CrudRepositoryTrait;

    public $model;

    public function __construct(Company $model)
    {
        $this->model = $model;
    }

    public function checkRole()
    {

    }
}
