<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductBatch;
use App\Models\SubCategory;
use App\Repositories\ProductBatchRepository;
use Illuminate\Http\Request;

class ProductBatchController extends Controller
{
    public $model;

    public function __construct(ProductBatchRepository $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $user = auth()->user();
        if ($user->hasRole('super-admin')) {
            $productBatches = ProductBatch::all();
        } else {
            $productBatches = ProductBatch::where('user_id', $user->id)->get();
        }
        return view('admin.product-batches.index',[
           'productBatches' =>$productBatches
        ]);
    }


    public function create()
    {
        $categories = SubCategory::pluck('title','id');
        return view('admin.product-batches.create',[
            'categories' => $categories
        ]);
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $this->model->store($data);
        return redirect()->route('admin.product-batches.index')->with('message', 'New Product Added Successfully');
    }


    public function show(Role $product)
    {
        //
    }


    public function edit($id)
    {
        $product = ProductBatch::findOrFail($id);
        $categories = Category::where('parent_id','!=',0)->pluck('title','id');
        return view('admin.product-batches.edit',[
            'model' =>$product,
            'categories' => $categories
        ]);
    }


    public function update(Request $request, $id)
    {
        $role = ProductBatch::findOrFail($id);
        $this->model->update($role->id, $request->all());
        return redirect()->route('admin.product-batches.index')->with('message', ' Roles Updated');
    }

    public function destroy(Role $role)
    {
        $this->model->delete($role->id);
        return redirect()->back()->with('message', 'Role Deleted Successfully');
    }


}
