@extends('layouts.backend.master')
@section('content')
    <!-- Content -->
    <div class="admin-content">
        <div class="page-header">
            <div>
                <h1>Orders</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="stat-card primary" style="padding: 1rem;">
                    <div class="stat-label">All Orders</div>
                    <div class="stat-value" style="font-size: 1.5rem;">{{ number_format($totalOrders) }}</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card warning" style="padding: 1rem;">
                    <div class="stat-label">Pending</div>
                    <div class="stat-value" style="font-size: 1.5rem;">{{ number_format($pendingOrders) }}</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card info" style="padding: 1rem;">
                    <div class="stat-label">Processing</div>
                    <div class="stat-value" style="font-size: 1.5rem;">{{ number_format($processingOrders) }}</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card success" style="padding: 1rem;">
                    <div class="stat-label">Delivered</div>
                    <div class="stat-value" style="font-size: 1.5rem;">{{ number_format($deliveredOrders) }}</div>
                </div>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="data-table-wrapper">
            <div class="data-table-header">
                <h6><i class="bi bi-cart-check me-2"></i>All Orders</h6>
                <form action="{{ route('admin.order.index') }}" method="GET" class="data-table-actions">
                    <div class="data-table-search">
                        <i class="bi bi-search"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search ID or Name...">
                    </div>
                    <select name="status" class="form-select form-select-sm" style="width: auto;"
                        onchange="this.form.submit()">
                        <option value="">All Status</option>
                        @foreach (\App\Enums\OrderStatus::cases() as $status)
                            <option value="{{ $status->value }}"
                                {{ request('status') == $status->value ? 'selected' : '' }}>
                                {{ $status->value }}
                            </option>
                        @endforeach
                    </select>
                    {{-- reset filter --}}
                    <a href="{{ route('admin.order.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-clockwise me-1"></i> Reset
                    </a>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table admin-table">
                    <thead>
                        <tr>
                            <th><input class="form-check-input" type="checkbox"></th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Products</th>
                            <th>Amount</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td><input class="form-check-input" type="checkbox"></td>
                                <td><a href="{{ route('admin.order.show', $order->id) }}"
                                        class="fw-600 text-primary">#{{ $order->order_number }}</a></td>
                                <td>
                                    <div class="customer-cell">
                                        <div
                                            class="customer-avatar {{ ['', 'green', 'orange', 'blue', 'red'][rand(0, 4)] }}">
                                            {{ substr($order->user->name ?? 'U', 0, 1) }}</div>
                                        <div>
                                            <div class="customer-name">{{ $order->user->name ?? 'U' }}</div>
                                            <div class="customer-email">{{ $order->user->phone ?? '' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="small">{{ $order->orderItems->count() }} items</span></td>
                                <td class="fw-600">৳{{ number_format($order->total_price, 2) }}</td>
                                <td><span
                                        class="badge bg-primary bg-opacity-10 text-primary">{{ $order->payment_method }}</span>
                                </td>
                                <td>
                                    <form action="{{ route('admin.order.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        <select name="status" class="form-select form-select-sm"
                                            style="width: 130px; font-size: 0.75rem;" onchange="this.form.submit()">
                                            @foreach (\App\Enums\OrderStatus::cases() as $status)
                                                <option value="{{ $status->value }}"
                                                    {{ $order->status === $status ? 'selected' : '' }}>
                                                    {{ $status->value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td class="text-muted small">{{ $order->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="action-btns">
                                        <a href="{{ route('admin.order.show', $order->id) }}" class="action-btn"
                                            title="View"><i class="bi bi-eye"></i></a>
                                        <a href="{{ route('admin.order.generateInvoice', $order->id) }}" class="action-btn"
                                            title="Print"><i class="bi bi-printer"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="data-table-footer">
                <span class="showing-text">Showing <strong>{{ $orders->firstItem() }}-{{ $orders->lastItem() }}</strong>
                    of <strong>{{ $orders->total() }}</strong></span>
                <nav>
                    {{ $orders->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        </div>
    </div>
@endsection`
