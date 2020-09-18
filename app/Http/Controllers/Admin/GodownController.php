<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Godown;
use App\Repositories\GodownRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class GodownController extends Controller
{
    public $model;

    public function __construct(GodownRepository $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $user = auth()->user();
        $godowns = [];
        if ($user->hasRole('super-admin')) {
            $godowns = Godown::all();
        } else {
            foreach ($user->companies as $company) {
                $godown = Godown::where('company_id', $company->id)->get();
                array_push($godowns, $godown);
            }
            $godowns = Arr::collapse($godowns);
        }
        return view('admin.godowns.index')->with('godowns', $godowns);
    }

    public function create()
    {
        $user = auth()->user();
        $companies = $user->companies()->get();
        if ($user->hasRole('super-admin')) {
            $companies = Company::all();
        }
        if ($companies->isEmpty()) {
            return redirect()->back()->with('message', 'You are not linked to an active company.');
        }
        return view('admin.godowns.create')->with('companies', $companies);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = auth()->id();
        $this->model->store($data);
        return redirect()->route('admin.godowns.index')->with('message', 'Godown has been created');
    }

    public function show(Godown $godown)
    {
        return view('godowns.view')->with('godown', $godown);
    }

    public function edit(Godown $godown)
    {
//        $companies = Company::active()->get();
        $companies = Company::all();
        return view('admin.godowns.edit')->with(['godown' => $godown, 'companies' => $companies]);
    }

    public function update(Request $request, Godown $godown)
    {
        $data = $request->all();
        $data['updated_by'] = auth()->id();
        $this->model->update($godown->id, $data);
        return redirect()->route('admin.godowns.index')->with('message', 'Godown has been updated');
    }

    public function destroy(Godown $godown)
    {
        $this->model->delete($godown->id);
        return redirect()->back()->with('message', 'Godown has been deleted');
    }

    public function getGodownByCompany($company_id)
    {
        $godowns = Godown::where('company_id', $company_id)->get();
        return json_encode($godowns);
    }
}
