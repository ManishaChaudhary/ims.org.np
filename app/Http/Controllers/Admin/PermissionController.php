<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public $model;

    public function __construct(PermissionRepository $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $permissions = $this->model->model->all();
        return view('admin.user-management.permissions.index',[
           'permissions' =>$permissions
        ]);
    }


    public function create()
    {
        return view('admin.user-management.roles.create');
    }


    public function store(Request $request)
    {
        $this->model->store($request->all());
        return redirect()->route('admin.roles.index')->with('message', 'New Role Created');
    }


    public function show(Role $product)
    {
        //
    }


    public function edit($id)
    {
        $roles = Permission::findOrFail($id);
        return view('admin.user-management.permissions.edit',[
            'model' =>$roles
        ]);
    }


    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $this->model->update($role->id, $request->all());
        return redirect()->route('admin.roles.index')->with('message', ' Roles Updated');
    }

    public function destroy(Role $role)
    {
        $this->model->delete($role->id);
        return redirect()->back()->with('message', 'Role Deleted Successfully');
    }


}
