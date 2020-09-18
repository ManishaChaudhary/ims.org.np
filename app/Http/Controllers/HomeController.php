<?php

namespace App\Http\Controllers;
use App\Models\Company;
use App\Models\Godown;
use App\Models\ProductBatch;
use App\User;


/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();
        $products = ProductBatch::all();
        $companies = Company::all();
        $godowns = Godown::all();
        return view('admin.dashboard',[
            'users' => $users,
            'products' => $products,
            'companies' => $companies,
            'godowns' => $godowns
        ]);
    }
}
