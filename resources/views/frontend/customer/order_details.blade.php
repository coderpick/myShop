@extends('layouts.frontend.HomeLayout')

@section('content')
    <section class="order-details py-5 bg-light">
        <div class="container">
            <!-- Breadcrumb / Back Button -->
            <div class="mb-4 d-flex align-items-center justify-content-between">
                <div>
                    <a href="{{ route('customer.dashboard') }}" class="btn btn-white shadow-sm rounded-pill px-4 btn-sm">
                        <i class="bi bi-arrow-left me-2"></i> Back to Dashboard
                    </a>
                </div>
                <div class="text-end">
                    <span class="text-muted small">Order Date:</span>
                    <span class="fw-bold d-block">{{ $order->created_at->format('M d, Y, h:i A') }}</span>
                </div>
            </div>

            <div class="row g-4">
                <!-- Order Items & Summary -->
                <div class="col-lg-8">
                    <!-- Order Items -->
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                        <div class="card-header bg-white p-4 border-0">
                            <h5 class="fw-bold mb-0">Order Items ({{ $order->orderItems->count() }})</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4">Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th class="text-end pe-4">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center gap-3">
                                                    @if($item->product->images->count() > 0)
                                                        <img src="{{ asset($item->product->images->first()->image_path) }}" 
                                                             alt="{{ $item->product->name }}" class="rounded-3" width="60">
                                                    @else
                                                        <div class="bg-light rounded-3 d-flex align-items-center justify-content-center" style="width:60px; height:60px;">
                                                            <i class="bi bi-image text-muted"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-0 fw-600">{{ $item->product->name }}</h6>
                                                        <span class="text-muted small">ID: #{{ $item->product->id }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>৳{{ number_format($item->price, 2) }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td class="text-end pe-4 fw-bold">৳{{ number_format($item->price * $item->quantity, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Payment & Shipping Info -->
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body p-4">
                                    <h6 class="fw-bold mb-3 border-bottom pb-2">Payment Details</h6>
                                    <div class="mb-2 d-flex justify-content-between">
                                        <span class="text-muted">Method:</span>
                                        <span class="fw-600 text-uppercase">{{ $order->payment_method }}</span>
                                    </div>
                                    <div class="mb-0 d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Status:</span>
                                        <span class="badge {{ $order->payment_status === 'Successful' ? 'bg-success' : 'bg-warning' }} bg-opacity-10 {{ $order->payment_status === 'Successful' ? 'text-success' : 'text-warning' }}">
                                            {{ strtoupper($order->payment_status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body p-4">
                                    <h6 class="fw-bold mb-3 border-bottom pb-2">Shipping Address</h6>
                                    <p class="text-muted small mb-0 lh-lg">
                                        <i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}<br>
                                        <i class="bi bi-geo-alt-fill me-1"></i> {{ auth()->user()->address ?? 'No address provided' }}<br>
                                        <i class="bi bi-telephone-fill me-1"></i> {{ auth()->user()->phone ?? 'No phone provided' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary Sidebar -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 100px;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Order Summary</h5>
                            
                            <div class="mb-3 d-flex justify-content-between">
                                <span class="text-muted">Order Number:</span>
                                <span class="fw-bold">#{{ $order->order_number }}</span>
                            </div>
                            <div class="mb-3 d-flex justify-content-between align-items-center">
                                <span class="text-muted">Status:</span>
                                <span class="badge {{ $order->status->badge() }} bg-opacity-10 {{ $order->status->text() }} px-3 py-2">
                                    {{ strtoupper($order->status->value) }}
                                </span>
                            </div>
                            
                            <hr class="my-4">

                            <div class="mb-3 d-flex justify-content-between">
                                <span class="text-muted">Subtotal:</span>
                                <span>৳{{ number_format($order->total_price, 2) }}</span>
                            </div>
                            <div class="mb-3 d-flex justify-content-between text-success">
                                <span class="">Shipping Fee:</span>
                                <span>Free</span>
                            </div>
                            <div class="mt-4 pt-3 border-top d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 fw-bold">Total Amount:</h5>
                                <h4 class="mb-0 fw-bold text-primary">৳{{ number_format($order->total_price, 2) }}</h4>
                            </div>

                            @if($order->status === \App\Enums\OrderStatus::DELIVERED)
                                <div class="mt-5">
                                    <a href="{{ route('customer.order.invoice', $order->id) }}" class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm">
                                        <i class="bi bi-download me-2"></i> Download Invoice
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .fw-600 { font-weight: 600; }
        .btn-white {
            background-color: #fff;
            color: #333;
            border: 1px solid #e9ecef;
        }
        .btn-white:hover {
            background-color: #f8f9fa;
        }
        .badge {
            font-weight: 600;
            letter-spacing: 0.5px;
            font-size: 0.7rem;
        }
        .table thead th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.5px;
            color: #6c757d;
        }
    </style>
@endsection
