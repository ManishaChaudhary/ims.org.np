<?php

namespace App\Repositories;

use App\Repositories\Traits\CrudRepositoryTrait;
use App\Models\Role;

class RoleRepository
{
    use CrudRepositoryTrait;

    public $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }
}
