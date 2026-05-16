<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Mail\OrderApprovedMail;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user', 'orderItems')->latest();

        // Search Filter (Order Number or Customer Name)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(10)->withQueryString();

        $stats = Order::selectRaw("
                    COUNT(*) as total,
                    SUM(CASE WHEN status = '".OrderStatus::PENDING->value."' THEN 1 ELSE 0 END) as pending,
                    SUM(CASE WHEN status = '".OrderStatus::PROCESSING->value."' THEN 1 ELSE 0 END) as processing,
                    SUM(CASE WHEN status = '".OrderStatus::DELIVERED->value."' THEN 1 ELSE 0 END) as delivered
                ")->first();

        $totalOrders = $stats->total;
        $pendingOrders = $stats->pending;
        $processingOrders = $stats->processing;
        $deliveredOrders = $stats->delivered;

        /*     $totalOrders = Order::count();
            $pendingOrders = Order::where('status', OrderStatus::PENDING)->count();
            $processingOrders = Order::where('status', OrderStatus::PROCESSING)->count();
            $deliveredOrders = Order::where('status', OrderStatus::DELIVERED)->count(); */

        return view('admin.order.index', compact('orders', 'totalOrders', 'pendingOrders', 'processingOrders', 'deliveredOrders'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'orderItems.product.images'])->findOrFail($id);

        return view('admin.order.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $order = Order::findOrFail($id);
        $oldStatus = $order->status;
        $newStatus = OrderStatus::from($request->status);

        // Status rollback logic: Cannot go back to Pending if already Confirmed or further
        if ($oldStatus !== OrderStatus::PENDING && $newStatus === OrderStatus::PENDING) {
            ToastMagic::warning('Cannot rollback status to Pending once it has been processed.');

            return redirect()->back();
        }

        // Auto-update payment status for COD orders when delivered
        if ($newStatus === OrderStatus::DELIVERED && strtolower($order->payment_method) === 'cod') {
            $order->payment_status = 'Successful';
        }

        $order->status = $newStatus;
        $order->save();

        // Send email with PDF invoice for all statuses except Pending (if status changed)
        if ($newStatus !== OrderStatus::PENDING && $oldStatus !== $newStatus) {
            try {
                $pdf = Pdf::loadView('admin.order.invoice', ['order' => $order->load('orderItems.product')])
                    ->setPaper('a4', 'portrait')
                    ->output();

                Mail::to($order->user->email)->send(new OrderApprovedMail($order, $pdf));
            } catch (\Exception $e) {
                // Log error
            }
        }

        ToastMagic::success('Order status updated successfully');

        return redirect()->back();
    }

    public function generateInvoice($id)
    {
        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);
        $pdf = Pdf::loadView('admin.order.invoice', compact('order'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('invoice-'.$order->order_number.'.pdf');
    }
}
