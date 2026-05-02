<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ShopController extends Controller
{
    public function index(Request $request, $slug = null)
    {
        $query = Product::with(['images', 'category', 'subCategory', 'brand'])->where('status', 'published');

        $filterType = null;
        $filterItem = null;
        $routeName = Route::currentRouteName();

        if ($slug && $routeName === 'shop.category') {
            $filterItem = Category::where('slug', $slug)->firstOrFail();
            $query->where('category_id', $filterItem->id);
            $filterType = 'category';
        } elseif ($slug && $routeName === 'shop.subcategory') {
            $filterItem = SubCategory::where('slug', $slug)->firstOrFail();
            $query->where('sub_category_id', $filterItem->id);
            $filterType = 'subcategory';
        } elseif ($slug && $routeName === 'shop.brand') {
            $filterItem = Brand::where('slug', $slug)->firstOrFail();
            $query->where('brand_id', $filterItem->id);
            $filterType = 'brand';
        }

        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->latest('created_at');
                    break;
                case 'name':
                    $query->orderBy('name', 'asc');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        $products = $query->paginate(12);
        $categories = Category::withCount('products')->with('subCategories')->get();
        $brands = Brand::withCount('products')->get();

        return view('frontend.shop', compact('products', 'categories', 'brands', 'filterType', 'filterItem'));
    }
}
