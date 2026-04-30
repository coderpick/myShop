<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {

        $categories = Category::withCount('products')->get();
        $trendingProducts = Product::where('is_trending', true)
            ->with('images', 'category')
            ->latest()
            ->limit(8)
            ->get();
        $brands = Brand::get();

        return view('home', compact('categories', 'trendingProducts', 'brands'));
    }
}
