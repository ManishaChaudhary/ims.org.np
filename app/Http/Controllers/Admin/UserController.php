<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    public $model;

    /**
     * UserController constructor.
     * @param UserRepository $model
     */
    public function __construct(UserRepository $model)
    {
        $this->model = $model;
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function index(Request $request)
    {
        $users = User::all();
        return view('admin.user-management.users.index')->with('users', $users);
    }

    /**
     * @return $this
     */
    public function create()
    {
        $roles = Role::pluck('name','id');
        $companies = Company::where('status',1)->pluck('name','id');
        return view('admin.user-management.users.create')->with(['roles' => $roles, 'companies' => $companies]);
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt("password");
        try {
            $user = User::create($data);

        } catch (\Illuminate\Database\QueryException  $exception) {
            $errorCode = $exception->errorInfo[1];
            if ($errorCode == '1062') {
                return redirect()->route('admin.users.create')->with('message', "Email or phone has already been used");
            }
        }
        $user->assignRole($data['role_id']);
        $user->companies()->attach($data['company_id']);
        return redirect()->route('admin.users.index')->with('message', 'User Created');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name','id');
        $userRoles = $user->roles()->pluck('roles.id')->all();
        $companies = Company::where('status',1)->pluck('name','id');
        $userCompanies = $user->companies()->pluck('companies.id')->all();
        return view('admin.user-management.users.edit', compact('user', 'roles', 'userRoles', 'companies', 'userCompanies'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return $this
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $user = User::findORFail($id);
        try {
            $user->update($data);
        } catch (\Illuminate\Database\QueryException  $exception) {
            $errorCode = $exception->errorInfo[1];
            if ($errorCode == '1062') {
                return redirect()->route('admin.users.create')->with('message', "Email or phone has already been used");
            }
        }
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        DB::table('company_user')->where('user_id', $id)->delete();
        $user->assignRole($request->input('roles'));
        $this->model->assignCompany($data['companies'], $user);
        return redirect()->route('admin.user-management.users.index')->with('message', 'User updated');
    }

    /**
     * @param $id
     * @return $this
     */
    public function destroy($id)
    {
        $this->model->delete($id);
        return redirect()->route('admin.user-management.users.index')
            ->with('message', 'User deleted successfully');
    }

    /**
     * @param $user_id
     * @param $company_id
     * @return $this
     */
    public function removeCompany($user_id, $company_id)
    {
        $user = User::findOrFail($user_id);
        $user->companies()->detach($company_id);
        return redirect()->back()->with('message', 'Company removed for user');
    }
}
