<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\Godown;
use App\Models\Product;
use App\Models\ProductBatch;
use App\Models\ProductReturn;
use App\Models\ProductReturnDetail;
use App\Models\SubCategory;
use App\Repositories\ProductReturnRepository;
use Illuminate\Http\Request;

class ProductReturnController extends Controller
{
    public $model;

    public function __construct(ProductReturnRepository $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $productReturns = ProductReturn::all();
        return view('admin.product-returns.index',[
           'productReturns' =>$productReturns
        ]);
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
        return view('admin.product-returns.create',[
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
        $productReturn  = new ProductReturn();
        $productReturn->party = $request->party;
        $productReturn->user_id = auth()->user()->id;
        $productReturn->in_date = $request->in_date;
        $productReturn->vehicle_no = $request->vehicle_no;
        $productReturn->weight = 0;
        $productReturn->company_id = $request->company_id;
        $productReturn->godown_id = $request->godown_id;
        $productReturn->in_details = '';
        $productReturn->location = $request->location;
        $productReturn->phone = $request->phone;
        if ($productReturn->save()) {
            $id = $productReturn->id;
            for ($count = 0; $count < count($request->product_id); $count++) {
                $data = [
                    'product_return_id' => $id,
                    'product_id' => $request->product_id[$count],
                    'category_id'=> $request->category_id[$count],
                    'subcategory_id'=> $request->subcategory_id[$count],
                    'product_batch_id'=> $request->product_batch_id[$count],
                    'quantity' => $request->quantity[$count],
                    'alt_quantity' => $request->alt_quantity[$count]
                ];
                $insert_data[] = $data;
            }
            ProductReturnDetail::insert($insert_data);
        }
        return redirect()->route('admin.product-returns.index')->with('message', 'New Product Added Successfully');
    }


    public function show(Role $product)
    {
        //
    }


    public function edit($id)
    {

        $model = ProductReturn::findOrFail($id);
        $user = auth()->user();
        $companies = $user->companies()->get();
        if ($user->hasRole('super-admin')) {
            $companies = Company::all();
        }

        $productReturnDetails = ProductReturnDetail::where('product_return_id',$model->id)->get();
        $products = Product::pluck('name','id');
        $categories = Category::pluck('title','id');
        $subcategories = SubCategory::pluck('title', 'id');
        $productBatches = ProductBatch::pluck('name', 'id');
        $godown = Godown::pluck('title','id');
        return view('admin.product-returns.edit')->with([
            'companies' => $companies,
            'model' => $model,
            'productReturnDetails' => $productReturnDetails,
            'godown' => $godown,
            'products' =>$products,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'productBatches' => $productBatches,
        ]);
    }


    public function update(Request $request, $id)
    {
        $role = ProductBatch::findOrFail($id);
        $this->model->update($role->id, $request->all());
        return redirect()->route('admin.product-returns.index')->with('message', ' Roles Updated');
    }

    public function destroy(Role $role)
    {
        $this->model->delete($role->id);
        return redirect()->back()->with('message', 'Role Deleted Successfully');
    }


}
