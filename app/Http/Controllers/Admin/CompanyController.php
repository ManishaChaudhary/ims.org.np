<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{

    public $model;
    public $role;

    public function __construct(CompanyRepository $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $companies = $this->model->model->all();
        return view('admin.companies.index')->with('companies', $companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = auth()->id();
        $this->model->store($data);
        return redirect()->route('admin.companies.index')->with('message', 'Company has been created');
    }

    public function show(Company $company)
    {
        $godowns = Godown::where('company_id', $company->id)->get();
        return view('companies.view')->with(['company' => $company, 'godowns' => $godowns]);
    }

    public function edit(Company $company)
    {
        return view('admin.companies.edit')->with('model', $company);
    }

    public function update(Request $request, Company $company)
    {
        $data = $request->all();
        $data['updated_by'] = auth()->id();
        $this->model->update($company->id, $data);
        return redirect()->route('admin.companies.index')->with('message', 'Company has been updated');
    }

    public function destroy(Company $company)
    {
        $this->model->delete($company->id);
        return redirect()->back()->with('message', 'Company has been deleted');
    }
}
