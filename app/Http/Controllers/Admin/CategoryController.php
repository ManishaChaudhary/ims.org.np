<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public $model;

    public function __construct(CategoryRepository $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $categories = $this->model->model->paginate(10);
        return view('admin.categories.index')->with('categories', $categories);
    }

    public function create()
    {
        $products = Product::pluck('name', 'id');
        $parentCategory = Category::where('parent_id',0)->get();
        $categories = $parentCategory->pluck('title','id');
        return view('admin.categories.create',[
            'products'=>$products,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $this->model->store($request->all());
        return redirect()->route('admin.categories.index')->with('message', 'New Category Created');
    }

    public function show(Category $category)
    {
        return view('categories.view')->with('category', $category);
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::pluck('name', 'id');
        $parentCategory = Category::where('parent_id',0)->get();
        $categories = $parentCategory->pluck('title','id');
        return view('admin.categories.edit')->with(['model'=> $category,'products'=>$products,'categories' => $categories]);
    }

    public function update(Request $request, Category $category)
    {
        $category = Category::findOrFail($category->id);
        $data = $request->all();
        $category->fill($data)->save();
        return redirect()->route('admin.categories.index')->with('message', ' Category Updated');
    }

    public function destroy(Category $category)
    {
        $this->model->delete($category->id);
        return redirect()->back()->with('message', 'Category deleted');
    }
}
