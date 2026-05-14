@extends('layouts.frontend.HomeLayout')

@section('content')
    <div class="container py-5 text-center">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-5">
                        <i class="bi bi-check-circle text-success" style="font-size: 5rem;"></i>
                        <h3 class="mt-4 mb-3">Payment Successful!</h3>
                        <p class="text-muted">Thank you for your purchase. Your payment has been successfully processed via
                            SSLCommerz.</p>

                        @if (isset($order))
                            <div class="bg-light rounded p-3 my-4">
                                <p class="mb-1"><strong>Order Number:</strong> {{ $order->order_number }}</p>
                                <p class="mb-1"><strong>Transaction ID:</strong> {{ $order->transaction_id }}</p>
                                <p class="mb-0"><strong>Total Amount:</strong>
                                    ৳{{ number_format($order->total_price, 2) }}</p>
                            </div>
                        @endif

                        <div class="mt-4 d-flex justify-content-center gap-3">
                            <a href="{{ route('customer.dashboard') }}" class="btn btn-primary px-4 py-2">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Go Dashboard to Track Order
                            </a>
                            <a href="{{ url('/') }}" class="btn btn-outline-secondary px-4 py-2">
                                <i class="bi bi-house me-1"></i> Go to Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
