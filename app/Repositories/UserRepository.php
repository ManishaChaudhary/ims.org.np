<?php

namespace App\Repositories;

use App\Repositories\Traits\CrudRepositoryTrait;
use App\User;

class UserRepository
{
    use CrudRepositoryTrait;

    public $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function assignCompany($companies , $user)
    {
        foreach ($companies as $company) {
            $user->companies()->attach($company);
        }
    }
}
