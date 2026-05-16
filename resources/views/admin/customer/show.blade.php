@extends('layouts.backend.master')
@section('content')
    <div class="admin-content">
        <div class="page-header">
            <div>
                <h1>Customer Profile</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.customer.index') }}">Customers</a></li>
                        <li class="breadcrumb-item active">{{ $customer->name }}</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.customer.index') }}" class="btn btn-outline-info btn-sm"><i
                    class="bi bi-arrow-left me-1"></i> Back to customers</a>
        </div>

        <div class="row g-4">
            <!-- Customer Info -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body text-center py-4">
                        <div class="customer-avatar mx-auto mb-3 orange"
                            style="width: 80px; height: 80px; font-size: 2rem; line-height: 80px;">
                            {{ substr($customer->name ?? 'C', 0, 1) }}
                        </div>
                        <h5 class="mb-1">{{ $customer->name }}</h5>
                        <p class="text-muted small mb-3">{{ $customer->email }}</p>
                        <div class="d-flex justify-content-center gap-2">
                            @if ($customer->status == 'active')
                                <span class="badge bg-success bg-opacity-10 text-success">Active Account</span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger">Inactive Account</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0"><i class="bi bi-person-lines-fill me-2"></i>Contact Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="small text-muted mb-1 d-block">Phone Number</label>
                            <span class="fw-bold">{{ $customer->phone ?? 'N/A' }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted mb-1 d-block">Address</label>
                            <span class="fw-bold">{{ $customer->address ?? 'N/A' }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted mb-1 d-block">City / Postal Code</label>
                            <span class="fw-bold">{{ $customer->city ?? 'N/A' }} /
                                {{ $customer->postal_code ?? 'N/A' }}</span>
                        </div>
                        <div class="mb-0">
                            <label class="small text-muted mb-1 d-block">Member Since</label>
                            <span class="fw-bold">{{ $customer->created_at->format('d F, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order History -->
            <div class="col-lg-8">
                <!-- Stats Summary -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="stat-card primary p-3">
                            <div class="stat-label text-secondary-50 small">Total Orders</div>
                            <div class="stat-value text-black h3 mb-0">{{ $customer->orders->count() }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-card success p-3">
                            <div class="stat-label text-secondary-50 small">Total Spent</div>
                            <div class="stat-value text-black h3 mb-0">
                                ৳{{ number_format($customer->orders->where('payment_status', 'Successful')->sum('total_price'), 2) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0"><i class="bi bi-cart-check me-2"></i>Order History</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3">Order ID</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th class="text-end pe-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($customer->orders as $order)
                                        <tr>
                                            <td class="ps-3 fw-bold">#{{ $order->order_number }}</td>
                                            <td>{{ $order->created_at->format('d M, Y') }}</td>
                                            <td class="fw-bold">৳{{ number_format($order->total_price, 2) }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $order->status->badge() }} bg-opacity-10 {{ $order->status->text() }}">
                                                    {{ strtoupper($order->status->value) }}
                                                </span>
                                            </td>
                                            <td class="text-end pe-3">
                                                <a href="{{ route('admin.order.show', $order->id) }}"
                                                    class="btn btn-sm btn-outline-primary py-0 px-2" title="View Details">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4 text-muted">No orders placed yet.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
