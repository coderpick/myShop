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
use App\Traits\FileUploadWithResizeTrait;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use FileUploadWithResizeTrait;

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
        $product = Product::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'discount_price' => $request->discount_price,
            'stock' => $request->stock,
            'sku' => $request->sku,
            'low_stock_alert' => $request->low_stock_alert,
            'status' => $request->status,
            'is_popular' => $request->has('is_popular'),
            'is_trending' => $request->has('is_trending'),
            'is_bestseller' => $request->has('is_bestseller'),
            'is_featured' => $request->has('is_featured'),
            'is_new_arrival' => $request->has('is_new_arrival'),
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $this->upload($image, 'uploads/products', false, true, 800, 800);
                if ($imagePath) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $imagePath,
                    ]);
                }
            }
        }

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
        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'discount_price' => $request->discount_price,
            'stock' => $request->stock,
            'sku' => $request->sku,
            'low_stock_alert' => $request->low_stock_alert,
            'status' => $request->status,
            'is_popular' => $request->has('is_popular'),
            'is_trending' => $request->has('is_trending'),
            'is_bestseller' => $request->has('is_bestseller'),
            'is_featured' => $request->has('is_featured'),
            'is_new_arrival' => $request->has('is_new_arrival'),
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $this->upload($image, 'uploads/products', false, true, 800, 800);
                if ($imagePath) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $imagePath,
                    ]);
                }
            }
        }

        ToastMagic::success('Product updated successfully');

        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::with('images')->findOrFail($id);

        // Delete physical images
        foreach ($product->images as $image) {
            $this->delete($image->image_path);
        }

        // Delete product (cascading will delete ProductImage records)
        $product->delete();

        ToastMagic::success('Product deleted successfully');

        return redirect()->route('admin.product.index');
    }

    public function deleteImage(string $id)
    {
        $image = ProductImage::findOrFail($id);
        $this->delete($image->image_path);
        $image->delete();

        return response()->json(['status' => 'success', 'message' => 'Image deleted successfully']);
    }
}
