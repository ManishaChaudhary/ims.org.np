<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\ChallanIn;
use App\Models\ChallanProduct;
use App\Models\Company;
use App\Http\Controllers\Controller;
use App\Models\Godown;
use App\Models\Product;
use App\Models\ProductBatch;
use App\Models\SubCategory;
use App\Repositories\ChallanInRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ChallanInController extends Controller
{

    public $model;

    public function __construct(ChallanInRepository $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $user = auth()->user();
        if ($user->hasRole('super-admin')) {
            $challans = ChallanIn::all();
        } else {
            $challans = ChallanIn::where('user_id', $user->id)->get();
        }
        return view('admin.challans.challan-in.index')->with('challans', $challans);
    }


    public function create()
    {
        $user = auth()->user();
        $companies = $user->companies()->get();
        if ($user->hasRole('super-admin')) {
            $companies = Company::all();
        }

        $products = Product::pluck('name','id');
        $categories = Category::pluck('title','id');
        $subcategories = SubCategory::pluck('title', 'id');
        $productBatches = ProductBatch::pluck('name', 'id');
        $godown = Godown::pluck('title','id');

        return view('admin.challans.challan-in.create')->with([
            'companies' => $companies,
            'productBatches' => $productBatches,
            'subcategories' => $subcategories,
            'godown' => $godown,
            'products' =>$products,
            'categories' => $categories
        ]);
    }


    public function store(Request $request)
    {
        $challanin = new ChallanIn;
        $challanin->party = $request->party;
        $challanin->user_id = auth()->user()->id;
        $challanin->in_date = $request->in_date;
        $challanin->vehicle_no = $request->vehicle_no;
        $challanin->weight = 0;
        $challanin->company_id = $request->company_id;
        $challanin->godown_id = $request->godown_id;
        if ($challanin->save()) {
            $id = $challanin->id;
            for ($count = 0; $count < count($request->product_id); $count++) {
                $data = [
                    'challani_id' => $id,
                    'product_id' => $request->product_id[$count],
                    'category_id'=> $request->category_id[$count],
                    'subcategory_id'=> $request->subcategory_id[$count],
                    'product_batch_id'=> $request->product_batch_id[$count],
                    'quantity' => $request->quantity[$count],
                    'alt_quantity' => $request->alt_quantity[$count]
                ];
                $insert_data[] = $data;
            }
            ChallanProduct::insert($insert_data);
        }
        return redirect()->route('admin.challans.index')->with('message', 'New Role Created');
    }

    public function show($id)
    {
        $challan = ChallanIn::where('id', $id)->with(['company', 'godown'])->first();
        return view('challans.entry-view')->with('challan', $challan);
    }


    public function edit($id)
    {
        $model = ChallanIn::findOrFail($id);
        $user = auth()->user();
        $companies = $user->companies()->get();
        if ($user->hasRole('super-admin')) {
            $companies = Company::all();
        }

        $challaniProducts = ChallanProduct::where('challani_id',$model->id)->get();
        $products = Product::pluck('name','id');
        $categories = Category::pluck('title','id');
        $subcategories = SubCategory::pluck('title', 'id');
        $productBatches = ProductBatch::pluck('name', 'id');
        $godown = Godown::pluck('title','id');
        return view('admin.challans.challan-in.edit')->with([
            'companies' => $companies,
            'model' => $model,
            'challaniProducts' => $challaniProducts,
            'godown' => $godown,
            'products' =>$products,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'productBatches' => $productBatches,
        ]);
    }

    public function update(Request $request, $id)
    {
        $challanIn = ChallanIn::findOrFail($id);
        $data = $request->all();
        $challanIn->fill($data)->save();
        return redirect()->route('admin.challans.index')->with('message', ' Challan Updated');
    }

    public function destroy($id)
    {
        $this->model->delete($id);
        return redirect()->back()->with('message', 'Category deleted');
    }

    public function getBatchesByGodown($godown_id)
    {
        $batches = ProductBatch::where('godown_id', $godown_id)->get();
        return $batches;
    }


    public function getBatchProducts($id)
    {
        $products = Product::where('batch_id', $id)->get();
        return $products;
    }

    public function addBatchContainer(Request $request)
    {
        $count = $request->get('count');
        return view('forms.challan-in-batch', ['count' => $count])->render();
    }

    public function addProductsContainer(Request $request)
    {
        $counter = $request->get('counter');
        $batchCounter = $request->get('batchCount');
        return view('forms.challan-in-products', ['counter' => $counter, 'batchCount' => $batchCounter])->render();
    }
}
