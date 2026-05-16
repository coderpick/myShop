<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); 
        $orders = $user->orders()->latest()->paginate(5);
        $totalOrders = $user->orders()->count();
        $totalSpent = $user->orders()->where('payment_status', 'Successful')->sum('total_price');
        $pendingOrders = $user->orders()->where('status', \App\Enums\OrderStatus::PENDING)->count();

        return view('frontend.customer.dashboard', compact('orders', 'totalOrders', 'totalSpent', 'pendingOrders'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $user->update($request->only('name', 'email', 'phone', 'address'));

        return back()->with('success', 'Profile updated successfully!');
    }

    public function orderDetails($id)
    {
        $order = auth()->user()->orders()
            ->with(['orderItems.product.images'])
            ->findOrFail($id);

        return view('frontend.customer.order_details', compact('order'));
    }

    public function downloadInvoice($id)
    {
        $order = auth()->user()->orders()
            ->with(['orderItems.product'])
            ->findOrFail($id);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.order.invoice', compact('order'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('invoice-' . $order->order_number . '.pdf');
    }
}
