<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $model;

    public function __construct(ProductRepository $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $products = Product::all();
        return view('admin.products.index',[
           'products' =>$products
        ]);
    }


    public function create()
    {
        return view('admin.products.create');
    }


    public function store(Request $request)
    {
        $data =$request->all();
        $data['user_id'] = auth()->id();
        $this->model->store($data);
        return redirect()->route('admin.products.index')->with('message', 'New Product Added Successfully');
    }


    public function show(Role $product)
    {
        //
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit',[
            'model' =>$product
        ]);
    }


    public function update(Request $request, $id)
    {
        $role = Product::findOrFail($id);
        $this->model->update($role->id, $request->all());
        return redirect()->route('admin.products.index')->with('message', ' Roles Updated');
    }

    public function destroy($id)
    {
        $this->model->delete($id);
        return redirect()->back()->with('message', 'Product Deleted Successfully');
    }


}
