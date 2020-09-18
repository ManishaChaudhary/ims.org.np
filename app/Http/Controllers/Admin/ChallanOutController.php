<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\ChallanOut;
use App\Models\ChallanOutProduct;
use App\Models\Company;
use App\Http\Controllers\Controller;
use App\Models\Godown;
use App\Models\Product;
use App\Models\ProductBatch;
use App\Models\SubCategory;
use App\Repositories\ChallanOutRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChallanOutController extends Controller
{
    public $model;

    public function __construct(ChallanOutRepository $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $user = auth()->user();
        if ($user->hasRole('super-admin')) {
            $challans = ChallanOut::all();
        } else {
            $challans = ChallanOut::where('user_id', $user->id)->get();
        }
        return view('admin.challans.challan-out.index')->with('challans', $challans);
    }


    public function create()
    {
        $user = auth()->user();
        $companies = $user->companies()->get();
        if ($user->hasRole('super-admin')) {
            $companies = Company::all();
        }
        $products = Product::pluck('name', 'id');
        $categories = Category::pluck('title', 'id');
        $subcategories = SubCategory::pluck('title', 'id');
        $productBatches = ProductBatch::pluck('name', 'id');
        $godown = Godown::pluck('title', 'id');
        return view('admin.challans.challan-out.create')->with([
            'companies' => $companies,
            'productBatches' => $productBatches,
            'subcategories' => $subcategories,
            'godown' => $godown,
            'products' => $products,
            'categories' => $categories
        ]);
    }


    public function store(Request $request)
    {
        $challanOut = new ChallanOut();
        $challanOut->party = $request->party;
        $challanOut->user_id = auth()->user()->id;
        $challanOut->out_date = $request->out_date;
        $challanOut->vehicle_no = $request->vehicle_no;
        $challanOut->company_id = $request->company_id;
        $challanOut->godown_id = $request->godown_id;
        if ($challanOut->save()) {
            $id = $challanOut->id;
            for ($count = 0; $count < count($request->product_id); $count++) {
                $data = [
                    'challani_out_id' => $id,
                    'product_id' => $request->product_id[$count],
                    'category_id' => $request->category_id[$count],
                    'subcategory_id' => $request->subcategory_id[$count],
                    'product_batch_id' => $request->product_batch_id[$count],
                    'quantity' => $request->quantity[$count],
                    'alt_quantity' => $request->alt_quantity[$count]
                ];
                $insert_data[] = $data;
            }
            ChallanOutProduct::insert($insert_data);
        }
        return redirect()->route('admin.challan-out.index')->with('message', 'New Challan out Created');

    }

    public function edit($id)
    {
        $model = ChallanOut::findOrFail($id);
        $user = auth()->user();
        $companies = $user->companies()->get();
        if ($user->hasRole('super-admin')) {
            $companies = Company::all();
        }

        $challaniOutProducts = ChallanOutProduct::where('challani_out_id', $model->id)->get();
        $products = Product::pluck('name', 'id');
        $categories = Category::pluck('title', 'id');
        $subcategories = SubCategory::pluck('title', 'id');
        $productBatches = ProductBatch::pluck('name', 'id');
        $godown = Godown::pluck('title', 'id');
        return view('admin.challans.challan-out.edit')->with([
            'companies' => $companies,
            'model' => $model,
            'challaniOutProducts' => $challaniOutProducts,
            'godown' => $godown,
            'products' => $products,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'productBatches' => $productBatches,
        ]);
    }

    public function productsByCompany($companyId)
    {
        $allProducts = [];
        $batches = ProductBatch::where('company_id', $companyId)->get();
        foreach ($batches as $batch) {
            $products = collect(Product::where('batch_id', $batch->id)->select('id', 'title')->get());
            array_push($allProducts, $products);
        }
        $allProducts = Arr::flatten($allProducts);
        return $allProducts;
    }

    public function addProductsContainer(Request $request)
    {
        $counter = $request->get('counter');
        return view('forms.challan-out-products', ['counter' => $counter])->render();
    }

}
