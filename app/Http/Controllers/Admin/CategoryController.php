<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Models\Category;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {

        if ($request->validated()) {

            //  Category::create($request->all());

            /*         $category = new Category();
                    $category->name = $request->name;
                    $category->slug = $request->slug;
                    $category->save(); */

            /*    Category::create([
                   'name' => $request->name,
                   'slug' => Str::slug($request->slug),
                   'icon' => $request->icon,
                   'is_show_in_menu' => $request->is_show_in_menu,
               ]); */

            Category::saveCategory($request);

            ToastMagic::success('Category Successfully Created');

            return redirect()->route('admin.category.index');
        }

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
        $category = Category::findOrFail($id);

        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$id,
            'icon' => 'nullable',
            'is_show_in_menu' => 'nullable|boolean',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'icon' => $request->icon,
            'is_show_in_menu' => $request->is_show_in_menu,
        ]);

        ToastMagic::success('Category Successfully Updated');

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        // $category = Category::where('id', $id)->first();

        $category->delete();
        ToastMagic::success('Category Successfully Deleted');

        return redirect()->route('admin.category.index');
    }
}
