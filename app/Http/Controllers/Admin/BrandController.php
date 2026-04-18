<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Traits\FileUploadTrait;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        $brands = Brand::get();

        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:brands,slug',
            'status' => 'required|boolean',
            'logo' => 'required|mimes:png,jpg,webp,jpeg|max:1024',
        ]);

        $logo = $this->fileUpload($request->logo, 'uploads/brand');

        Brand::create([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'status' => $request->status,
            'logo' => $logo,
        ]);

        ToastMagic::success('Brand Successfully Created');

        return redirect()->route('admin.brand.index');

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
        $brand = Brand::where('id', $id)->first();

        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:brands,slug,'.$id,
            'status' => 'required|boolean',
            'logo' => 'required|mimes:png,jpg,webp,jpeg|max:1024',
        ]);

        $brand = Brand::where('id', $id)->first();

        if ($request->hasFile('logo')) {
            $logo = $this->fileUpload($request->logo, 'uploads/brand', $brand->logo);
        }

        $brand->update([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'status' => $request->status,
            'logo' => $logo,
        ]);

        ToastMagic::success('Brand Successfully Updated');

        return redirect()->route('admin.brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::where('id', $id)->first();

        $this->unlink($brand->logo);

        $brand->delete();

        ToastMagic::success('Brand Successfully Deleted');

        return redirect()->route('admin.brand.index');
    }
}
