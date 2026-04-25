<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use App\Services\Admin\ProductService;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = Product::with(['brand:id,name', 'category:id,name', 'subCategory:id,name', 'images'])->latest()->get();

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::get();
        $categories = Category::get();

        return view('admin.product.create', compact('brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $this->productService->store($request->validated(), $request->file('images'));

        ToastMagic::success('Product added successfully');

        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with(['brand', 'category', 'subCategory', 'images'])->findOrFail($id);
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with('images')->findOrFail($id);
        $brands = Brand::get();
        $categories = Category::get();
        $subCategories = SubCategory::where('category_id', $product->category_id)->get();

        return view('admin.product.edit', compact('product', 'brands', 'categories', 'subCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $id)
    {
        $this->productService->update($id, $request->validated(), $request->file('images'));

        ToastMagic::success('Product updated successfully');

        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->productService->delete($id);

        ToastMagic::success('Product deleted successfully');

        return redirect()->route('admin.product.index');
    }

    /**
     * Delete a single product image.
     */
    public function deleteImage(string $id)
    {
        $this->productService->deleteImage($id);

        return response()->json(['status' => 'success', 'message' => 'Image deleted successfully']);
    }
}
