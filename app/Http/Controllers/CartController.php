<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'integer|min:1|max:100',
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity ?? 1;
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'product_id' => $product->id,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => $product->name . ' added to cart!',
            'count' => count($cart),
        ]);
    }

    public function getCartCount()
    {
        $cart = session()->get('cart', []);
        return response()->json(['count' => count($cart)]);
    }

    public function getCart()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return view('frontend.cart', ['cartItems' => collect(), 'total' => 0]);
        }

        $productIds = array_keys($cart);
        $products = Product::with('images')->whereIn('id', $productIds)->get();

        $cartItems = $products->map(function ($product) use ($cart) {
            return [
                'product' => $product,
                'quantity' => $cart[$product->id]['quantity'],
                'subtotal' => ($product->discount_price > 0 ? $product->discount_price : $product->price) * $cart[$product->id]['quantity'],
            ];
        });

        $total = $cartItems->sum('subtotal');

        return view('frontend.cart', compact('cartItems', 'total'));
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1|max:100',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);

            $product = Product::find($request->product_id);
            $subtotal = ($product->discount_price > 0 ? $product->discount_price : $product->price) * $request->quantity;

            return response()->json([
                'success' => true,
                'message' => 'Cart updated!',
                'subtotal' => $subtotal,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Item not found in cart.',
        ], 404);
    }

    public function removeFromCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'message' => 'Item removed from cart.',
                'count' => count($cart),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Item not found in cart.',
        ], 404);
    }

    public function clearCart()
    {
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared!',
        ]);
    }
}
