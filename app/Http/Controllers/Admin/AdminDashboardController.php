<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalSales = Order::where('payment_status', 'Successful')->sum('total_price');
        $totalOrders = Order::count();
        $totalCustomers = User::where('user_type', 'user')->count();
        $totalProducts = Product::count();
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        // Chart 1: Sales Overview (Last 6 Months)
        $salesData = Order::where('payment_status', 'Successful')
            ->selectRaw('SUM(total_price) as sum, MONTHNAME(created_at) as month, MIN(created_at) as sort_date')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('sort_date')
            ->get();

        $salesLabels = $salesData->pluck('month')->toArray();
        $salesValues = $salesData->pluck('sum')->toArray();

        // Chart 2: Orders by Category
        $categories = Category::withCount(['products as orders_count' => function ($query) {
            $query->whereHas('orderItems');
        }])->get();

        $categoryLabels = $categories->pluck('name')->toArray();
        $categoryValues = $categories->pluck('orders_count')->toArray();

        return view('admin.dashboard', compact(
            'totalSales',
            'totalOrders',
            'totalCustomers',
            'totalProducts',
            'recentOrders',
            'salesLabels',
            'salesValues',
            'categoryLabels',
            'categoryValues'
        ));
    }
}
