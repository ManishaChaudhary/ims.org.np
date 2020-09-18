<?php

namespace App\Helpers;


use App\Models\Permission;

class PermissionHelper
{
    public function getPermissions()
    {
        return Permission::all();
    }

}
