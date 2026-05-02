@extends('layouts.frontend.HomeLayout')
@section('pageTitle', 'Order Success')

@section('content')
    <section class="breadcrumb-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house-door"></i> Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Order Success</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="bg-white shadow-sm rounded p-5 text-center">
                        <div class="mb-4">
                            <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                        </div>
                        <h2 class="fw-bold mb-3">Order Placed Successfully!</h2>
                        <p class="text-muted mb-4">Thank you for your purchase. Your order has been confirmed and will be shipped soon.</p>

                        <div class="order-details bg-light rounded p-4 mb-4 text-start">
                            <h5 class="fw-bold mb-3">Order Details</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted small">Order Number</p>
                                    <p class="fw-bold mb-3">{{ $order->order_number }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted small">Order Date</p>
                                    <p class="fw-bold mb-3">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted small">Payment Method</p>
                                    <p class="fw-bold mb-3">{{ $order->payment_method === 'online' ? 'Online Payment' : 'Cash on Delivery' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted small">Payment Status</p>
                                    <p class="fw-bold mb-3">
                                        @if($order->payment_method === 'cod')
                                            <span class="badge bg-warning">Pay on Delivery</span>
                                        @elseif($order->payment_status === 'paid')
                                            <span class="badge bg-success">Paid</span>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted small">Customer Name</p>
                                    <p class="fw-bold mb-3">{{ $order->customer_name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted small">Customer Email</p>
                                    <p class="fw-bold mb-3">{{ $order->customer_email }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted small">Customer Phone</p>
                                    <p class="fw-bold mb-3">{{ $order->customer_phone }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted small">Order Status</p>
                                    <p class="fw-bold mb-3"><span class="badge bg-info">{{ $order->status }}</span></p>
                                </div>
                                <div class="col-12">
                                    <p class="mb-1 text-muted small">Shipping Address</p>
                                    <p class="fw-bold">{{ $order->shipping_address }}, {{ $order->city }}{{ $order->state ? ', ' . $order->state : '' }}{{ $order->postal_code ? ' - ' . $order->postal_code : '' }}</p>
                                </div>
                                @if($order->notes)
                                    <div class="col-12">
                                        <p class="mb-1 text-muted small">Order Notes</p>
                                        <p class="fw-bold">{{ $order->notes }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="order-items bg-light rounded p-4 mb-4 text-start">
                            <h5 class="fw-bold mb-3">Items Ordered</h5>
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->orderItems as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset($item->product->images->first()?->image_path ?? 'assets/frontend/images/placeholder.png') }}" alt="{{ $item->product->name }}" style="width: 50px; height: 50px; object-fit: cover;" class="rounded me-3">
                                                        <span class="fw-bold">{{ $item->product->name }}</span>
                                                    </div>
                                                </td>
                                                <td>${{ number_format($item->price, 2) }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td class="fw-bold">${{ number_format($item->total_price, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold fs-5">
                                <span>Total</span>
                                <span>${{ number_format($order->total_price, 2) }}</span>
                            </div>
                        </div>

                        <div class="d-flex gap-3 justify-content-center">
                            <a href="{{ route('shop') }}" class="btn btn-outline-custom">
                                <i class="bi bi-bag me-2"></i>Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
