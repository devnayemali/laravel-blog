<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sub_categories = SubCategory::with('category')->orderBy('id', 'desc')->get();
        return view('backend.modules.sub_category.index', compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        return view('backend.modules.sub_category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'min:3', 'max:255'],
            'category_id' => ['required'],
            'slug' => ['required', 'min:3', 'max:255', 'unique:sub_categories'],
            'order_by' => ['required', 'numeric'],
            'status' => ['required'],
        ]);

        $sub_category_data = $request->all();
        $sub_category_data['slug'] = Str::slug($request->input('slug'));
        SubCategory::create($sub_category_data);
        session()->flash('cls', 'success');
        session()->flash('msg', 'Sub Category Created Successfully.');
        return redirect()->route('sub-category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        $subCategory->load('category');
        return view('backend.modules.sub_category.show', compact('subCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        $categories = Category::pluck('name', 'id');
        return view('backend.modules.sub_category.edit', compact('subCategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $this->validate($request, [
            'name' => ['required', 'min:3', 'max:255'],
            'slug' => ['required', 'min:3', 'max:255', 'unique:categories,slug,'.$subCategory->id],
            'order_by' => ['required', 'numeric'],
            'status' => ['required'],
        ]);

        $sub_category_data = $request->all();
        $sub_category_data['slug'] = Str::slug($request->input('slug'));
        $subCategory->update($sub_category_data);
        session()->flash('cls', 'success');
        session()->flash('msg', 'Sub Category Updated Successfully.');
        return redirect()->route('sub-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        session()->flash('cls', 'error');
        session()->flash('msg', 'Sub Category Delete Successfully');
        return redirect()->route('sub-category.index');
    }

    /**
     * Get Sub Category By Category Id
    */
    public function getSubCategorByCategoryId(int $id){
        $sub_categories = SubCategory::select('id','name')->where('status', 1)->where('category_id', $id)->get();
        return response()->json($sub_categories);
    }
}
