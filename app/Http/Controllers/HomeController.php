<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\FlashDealProduct;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Support\Carbon;

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

        $sliders = Slider::where('status', true)->get();
        /* flash deal products */
        $flashDealProducts = FlashDealProduct::where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->with('product', 'product.images')
            ->limit(6)
            ->get();

        return view('home', compact('categories', 'trendingProducts', 'brands', 'sliders', 'flashDealProducts'));
    }
}
