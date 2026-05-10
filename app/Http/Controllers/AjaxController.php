<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getSubcategoriesByCategory(Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->category_id)->get();

        // return response()->json([
        //     'subCategories' => $subCategories,
        // ]);

        $subCategoryOptions = '<option value="" disabled selected>Select Sub Category</option>';

        if ($subCategories->count() > 0) {
            foreach ($subCategories as $subCategory) {
                $subCategoryOptions .= '<option value="'.$subCategory->id.'">'.$subCategory->name.'</option>';
            }
        } else {
            $subCategoryOptions = '<option value="" disabled selected>No Sub Categories</option>';
        }

        return $subCategoryOptions;
    }
    public function getProductQuickView($id)
    {
        $product = \App\Models\Product::with(['category', 'images'])->findOrFail($id);

        $imagePath = $product->images->count() > 0 ? asset($product->images->first()->image_path) : 'https://via.placeholder.com/300x300/f1f5f9/2563eb?text=Product';

        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'category' => $product->category->name ?? 'Uncategorized',
            'price' => number_format((float)$product->price, 2),
            'discount' => $product->discount,
            'discount_price' => $product->discount_price ? number_format((float)$product->discount_price, 2) : 0,
            'short_description' => $product->short_description ?? '',
            'image' => $imagePath,
            'product_url' => route('product.show', $product->slug)
        ]);
    }
}
