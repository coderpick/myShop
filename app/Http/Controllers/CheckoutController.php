<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function step($step = null)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $validSteps = [1, 2, 3, 4];
        if ($step && !in_array($step, $validSteps)) {
            return redirect()->route('checkout.step', 1);
        }

        $currentStep = $step ?? session('checkout_step', 1);
        session(['checkout_step' => $currentStep]);

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
        $checkoutData = session('checkout_data', []);
        $user = Auth::user();

        return view('frontend.checkout', compact('cartItems', 'total', 'currentStep', 'checkoutData', 'user'));
    }

    public function submitStep(Request $request, $step)
    {
        $checkoutData = session('checkout_data', []);

        switch ($step) {
            case 1:
                if (!Auth::check()) {
                    $validated = $request->validate([
                        'email' => 'required|email',
                        'name' => 'required|string',
                        'phone' => 'required|string',
                    ]);
                    $checkoutData = array_merge($checkoutData, $validated);
                }
                break;

            case 2:
                $validated = $request->validate([
                    'shipping_address' => 'required|string',
                    'mobile_number' => 'required|string|max:20',
                    'city' => 'required|string|max:100',
                    'state' => 'nullable|string|max:100',
                    'postal_code' => 'nullable|string|max:20',
                    'notes' => 'nullable|string',
                ]);
                $checkoutData = array_merge($checkoutData, $validated);

                if (Auth::check()) {
                    Auth::user()->update([
                        'address' => $validated['shipping_address'],
                        'phone' => $validated['mobile_number'],
                    ]);
                }
                break;

            case 3:
                $validated = $request->validate([
                    'payment_method' => 'required|in:online,cod',
                ]);
                $checkoutData = array_merge($checkoutData, $validated);
                break;
        }

        session(['checkout_data' => $checkoutData]);

        $nextStep = $step + 1;
        session(['checkout_step' => $nextStep]);

        return redirect()->route('checkout.step', $nextStep);
    }

    public function placeOrder()
    {
        $checkoutData = session('checkout_data', []);
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        if (Auth::check()) {
            $user = Auth::user();
            $customerName = $checkoutData['name'] ?? $user->name;
            $customerEmail = $checkoutData['email'] ?? $user->email;
            $customerPhone = $checkoutData['phone'] ?? $user->phone;
        } else {
            $customerName = $checkoutData['name'] ?? '';
            $customerEmail = $checkoutData['email'] ?? '';
            $customerPhone = $checkoutData['phone'] ?? '';
        }

        try {
            DB::beginTransaction();

            $productIds = array_keys($cart);
            $products = Product::whereIn('id', $productIds)->get();

            $total = 0;
            foreach ($products as $product) {
                $price = $product->discount_price > 0 ? $product->discount_price : $product->price;
                $total += $price * $cart[$product->id]['quantity'];
            }

            $order = Order::create([
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                'user_id' => Auth::id(),
                'customer_name' => $customerName,
                'customer_email' => $customerEmail,
                'customer_phone' => $customerPhone,
                'shipping_address' => $checkoutData['shipping_address'],
                'city' => $checkoutData['city'],
                'state' => $checkoutData['state'] ?? null,
                'postal_code' => $checkoutData['postal_code'] ?? null,
                'quantity' => array_sum(array_column($cart, 'quantity')),
                'total_price' => $total,
                'payment_method' => $checkoutData['payment_method'],
                'payment_status' => 'pending',
                'transaction_id' => null,
                'notes' => $checkoutData['notes'] ?? null,
                'status' => 'Pending',
            ]);

            foreach ($products as $product) {
                $price = $product->discount_price > 0 ? $product->discount_price : $product->price;
                $quantity = $cart[$product->id]['quantity'];

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'total_price' => $price * $quantity,
                ]);
            }

            session()->forget(['cart', 'checkout_data', 'checkout_step']);

            DB::commit();

            if ($checkoutData['payment_method'] === 'online') {
                return redirect()->route('checkout.payment', $order->id);
            }

            return redirect()->route('checkout.success', $order->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to place order. Please try again.');
        }
    }

    public function payment($orderId)
    {
        $order = Order::with('orderItems.product')->findOrFail($orderId);

        if ($order->payment_method !== 'online') {
            return redirect()->route('checkout.success', $order->id);
        }

        return view('frontend.payment', compact('order'));
    }

    public function processPayment(Request $request, $orderId)
    {
        $validated = $request->validate([
            'card_number' => 'required|string|digits:16',
            'card_name' => 'required|string|max:255',
            'expiry_date' => 'required|string|regex:/^\d{2}\/\d{2}$/',
            'cvv' => 'required|string|digits:3',
        ]);

        $order = Order::findOrFail($orderId);

        try {
            DB::beginTransaction();

            $transactionId = 'TXN-' . strtoupper(Str::random(10));

            $order->update([
                'payment_status' => 'paid',
                'transaction_id' => $transactionId,
                'status' => 'Confirmed',
            ]);

            DB::commit();

            return redirect()->route('checkout.success', $order->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Payment failed. Please try again.');
        }
    }

    public function success($orderId)
    {
        $order = Order::with('orderItems.product')->findOrFail($orderId);

        return view('frontend.order-success', compact('order'));
    }
}
