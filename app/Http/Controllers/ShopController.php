<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($category = null)
    {
        $products = Product::latest()->with(['images', 'category'])->get();

        return view('frontend.shop', compact('products'));
    }
}
