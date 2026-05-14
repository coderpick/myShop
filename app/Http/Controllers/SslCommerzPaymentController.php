<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Raziul\Sslcommerz\Facades\Sslcommerz;

class SslCommerzPaymentController extends Controller
{
    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');

        $isValid = Sslcommerz::validatePayment($request->all(), $tran_id, $amount);

        if ($isValid) {
            $order = Order::where('transaction_id', $tran_id)->first();
            if ($order) {
                $order->update([
                    'payment_status' => PaymentStatus::SUCCESSFUL->value,
                    'status' => OrderStatus::PENDING->value,
                ]);

                if ($order->user_id) {
                    Auth::loginUsingId($order->user_id);
                }

                return view('frontend.payment.success', compact('order'));
            }
        }

        // $order = Order::where('transaction_id', $tran_id)->first();

        return view('frontend.payment.failed');
    }

    public function failure(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $order = Order::where('transaction_id', $tran_id)->first();

        if ($order) {
            $order->update(['payment_status' => PaymentStatus::FAILED->value]);
            if ($order->user_id) {
                Auth::loginUsingId($order->user_id);
            }
        }

        return view('frontend.payment.failed', compact('order'));
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $order = Order::where('transaction_id', $tran_id)->first();

        if ($order) {
            $order->update(['payment_status' => PaymentStatus::CANCELED->value]);
            if ($order->user_id) {
                Auth::loginUsingId($order->user_id);
            }
        }

        return view('frontend.payment.failed', compact('order'));
    }

    public function ipn(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');

        if (Sslcommerz::verifyHash($request->all())) {
            $isValid = Sslcommerz::validatePayment($request->all(), $tran_id, $amount);
            if ($isValid) {
                $order = Order::where('transaction_id', $tran_id)->first();
                if ($order && $order->payment_status == PaymentStatus::PENDING->value) {
                    $order->update([
                        'payment_status' => PaymentStatus::SUCCESSFUL->value,
                        'status' => OrderStatus::PENDING->value,
                    ]);
                }
            }
        }

        return response()->json(['status' => 'IPN Processed']);
    }
}
