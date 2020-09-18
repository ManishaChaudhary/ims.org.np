<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Repositories\Traits\CrudRepositoryTrait;

class PermissionRepository
{
    use CrudRepositoryTrait;

    public $model;

    public function __construct(Permission $model)
    {
        $this->model = $model;
    }
}
