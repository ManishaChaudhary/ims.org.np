<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Repositories\SubCategoryRepository;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public $model;

    public function __construct(SubCategoryRepository $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $subcategories = $this->model->model->all();
        return view('admin.subcategories.index')->with('subcategories', $subcategories);
    }

    public function create()
    {
        $categories = Category::pluck('title','id');
        if ($categories->isEmpty()) {
            return redirect()->back()->with('message', 'Please create an Active Category first');
        }
        return view('admin.subcategories.create')->with('categories', $categories);
    }

    public function store(Request $request)
    {
        $this->model->store($request->all());
        return redirect()->route('admin.sub-categories.index')->with('message', 'New Sub-Category Created');
    }

    public function show(SubCategory $subcategory)
    {
        return view('subcategories.view')->with('subcategory', $subcategory);
    }

    public function edit(SubCategory $subcategory)
    {
        $categories = Category::active()->get();
        return view('subcategories.edit')->with(['subcategory' => $subcategory, 'categories' => $categories]);
    }

    public function update(Request $request, SubCategory $subcategory)
    {
        $this->model->update($subcategory->id, $request->all());
        return redirect()->route('admin.subcategories.index')->with('message', ' Sub-Category Updated');
    }

    public function destroy(Category $category)
    {
        $this->model->delete($category->id);
        return redirect()->back()->with('message', 'Sub-Category deleted');
    }

    public function subByCategory($category_id)
    {
        $subcategories = SubCategory::where('category_id', $category_id)->active()->get();
        return $subcategories;
    }
}
