<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Raziul\Sslcommerz\Facades\Sslcommerz;

class CheckoutController extends Controller
{
    public function index()
    {

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('shop')->with('error', 'Your cart is empty.');
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
        $user = Auth::user();

        return view('frontend.checkout.index', compact('cartItems', 'total', 'user'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'city' => 'required|string',
            'postal_code' => 'required|numeric',
            'address' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        // if (empty($cart)) {
        //     return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        // }

        $cart = session()->get('cart', []);

        try {
            DB::beginTransaction();

            /* update user info */
            $user = Auth::user();
            $user->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'address' => $request->address,
            ]);

            $productIds = array_keys($cart);
            $products = Product::whereIn('id', $productIds)->get();

            $total = 0;
            foreach ($products as $product) {
                $price = $product->discount_price > 0 ? $product->discount_price : $product->price;
                $total += $price * $cart[$product->id]['quantity'];
            }

            $order = Order::create([
                'order_number' => Order::generateInvoiceNumber(),
                'user_id' => Auth::id(),
                'quantity' => array_sum(array_column($cart, 'quantity')),
                'total_price' => $total,
                'payment_method' => $request->payment_method,
                'payment_status' => PaymentStatus::PENDING->value,
                'transaction_id' => null,
                'notes' => $request->notes ?? null,
                'status' => OrderStatus::PENDING->value,
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

            session()->forget(['cart']);

            DB::commit();

            if ($request->payment_method === 'online') {

                $transactionId = 'TXN-'.strtoupper(Str::random(10));
                $order->update(['transaction_id' => $transactionId]);

                $response = Sslcommerz::setOrder($total, $transactionId, 'Products')
                    ->setCustomer($user->name, $user->email, $user->phone)
                    ->setShippingInfo($order->quantity, $user->address)
                    ->makePayment();

                if ($response->success()) {
                    return redirect($response->gatewayPageURL());
                } else {
                    return redirect()->route('cart.index')->with('error', 'Failed to initiate payment gateway.');
                }
            }

            return view('frontend.payment.success', compact('order'));

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', 'Failed to place order. Please try again.');
        }

    }
}
