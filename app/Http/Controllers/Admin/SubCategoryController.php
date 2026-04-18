<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategories = SubCategory::with('category')->get();

        return view('admin.sub_category.index', compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();

        return view('admin.sub_category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'slug' => 'required|unique:sub_categories,slug',
        ]);
        SubCategory::create([
            'name' => $request->name,
            'category_id' => $request->category,
            'slug' => Str::slug($request->slug),
        ]);

        ToastMagic::success('Sub Category Successfully Created');

        return redirect()->route('admin.sub_category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::get();
        $subCategory = SubCategory::where('id', $id)->first();

        return view('admin.sub_category.edit', compact('categories', 'subCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'slug' => 'required|unique:sub_categories,slug,'.$id,
        ]);

        $subCategory = SubCategory::where('id', $id)->first();

        $subCategory->update([
            'name' => $request->name,
            'category_id' => $request->category,
            'slug' => Str::slug($request->slug),
        ]);

        ToastMagic::success('Sub Category Successfully Updated');

        return redirect()->route('admin.sub_category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->delete();

        ToastMagic::success('Sub Category Successfully Deleted');

        return redirect()->route('admin.sub_category.index');

    }
}
