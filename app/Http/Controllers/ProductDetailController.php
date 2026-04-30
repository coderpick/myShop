<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductDetailController extends Controller
{
    public function __invoke(string $slug)
    {

        $product = Product::with(['images', 'category'])->where('slug', $slug)->first();
        if (! $product) {
            abort(404);
        }

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->whereNotIn('id', [$product->id])
            ->with('images', 'category')
            ->take(4)->get();

        return view('frontend.product', compact('product', 'relatedProducts'));
    }
}
