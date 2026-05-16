@extends('layouts.backend.master')
@section('content')
    <div class="admin-content">
        <div class="page-header">
            <div>
                <h1>Order Details</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.order.index') }}">Orders</a></li>
                        <li class="breadcrumb-item active">#{{ $order->order_number }}</li>
                    </ol>
                </nav>
                <div class="mt-2">
                    <span class="badge {{ $order->status->badge() }} bg-opacity-10 {{ $order->status->text() }}">
                        {{ strtoupper($order->status->value) }}
                    </span>
                </div>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <a href="{{ route('admin.order.index') }}" class="btn btn-outline-info btn-sm"><i
                        class="bi bi-arrow-left me-1"></i> Back to orders</a>

                <a href="{{ route('admin.order.generateInvoice', $order->id) }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-printer me-1"></i> Print Invoice</a>
                <form action="{{ route('admin.order.updateStatus', $order->id) }}" method="POST" class="d-flex gap-2">
                    @csrf
                    <select name="status" class="form-select form-select-sm" style="width: auto;">
                        @foreach (\App\Enums\OrderStatus::cases() as $status)
                            <option value="{{ $status->value }}" {{ $order->status === $status ? 'selected' : '' }}>
                                {{ $status->value }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-admin-primary btn-sm">Update Status</button>
                </form>
            </div>
        </div>

        <div class="row g-4">
            <!-- Order Items -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0"><i class="bi bi-cart me-2"></i>Order Items</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset($item->product->images->first()->image_path ?? 'assets/images/no-image.png') }}"
                                                        alt="" class="rounded me-3"
                                                        style="width: 50px; height: 50px; object-fit: cover;">
                                                    <div>
                                                        <div class="fw-bold">{{ $item->product->name ?? 'Product' }}</div>
                                                        <small class="text-muted">SKU:
                                                            {{ $item->product->sku ?? 'N/A' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>৳{{ number_format($item->price, 2) }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td class="text-end fw-bold">৳{{ number_format($item->total_price, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end">Subtotal:</td>
                                        <td class="text-end fw-bold">৳{{ number_format($order->total_price, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end">Shipping:</td>
                                        <td class="text-end fw-bold">৳0.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end">Tax:</td>
                                        <td class="text-end fw-bold">৳0.00</td>
                                    </tr>
                                    <tr class="table-light">
                                        <td colspan="3" class="text-end fw-bold">Grand Total:</td>
                                        <td class="text-end fw-bold text-primary" style="font-size: 1.2rem;">
                                            ৳{{ number_format($order->total_price, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0"><i class="bi bi-chat-left-text me-2"></i>Order Notes</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">{{ $order->notes ?? 'No notes provided for this order.' }}</p>
                    </div>
                </div>
            </div>

            <!-- Customer & Shipping Info -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0"><i class="bi bi-person me-2"></i>Customer Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-sm bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                                style="width: 40px; height: 40px;">
                                <i class="bi bi-person"></i>
                            </div>
                            <div>
                                <div class="fw-bold">{{ $order->user?->name }}</div>
                                <div class="small text-muted">{{ $order->user?->email }}</div>
                            </div>
                        </div>
                        <div class="small text-muted mb-1">Phone:</div>
                        <div class="mb-3">{{ $order->user?->phone }}</div>
                        <hr>
                        <div class="small text-muted mb-1">Shipping Address:</div>
                        <address class="mb-0">
                            {{ $order->user?->address }}<br>
                            {{ $order->user?->city }}, {{ $order->user?->postal_code }}
                        </address>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0"><i class="bi bi-credit-card me-2"></i>Payment Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Payment Method:</span>
                            <span class="fw-bold">{{ strtoupper($order->payment_method) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Payment Status:</span>
                            <span
                                class="badge {{ $order->payment_status == 'paid' ? 'bg-success' : 'bg-warning' }} bg-opacity-10 {{ $order->payment_status == 'paid' ? 'text-success' : 'text-warning' }}">
                                {{ strtoupper($order->payment_status) }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Transaction ID:</span>
                            <span class="small">{{ $order->transaction_id ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
