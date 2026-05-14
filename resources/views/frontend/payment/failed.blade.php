@extends('layouts.frontend.HomeLayout')

@section('content')
    <div class="container py-5 text-center">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-5">
                        <i class="bi bi-x-circle text-danger" style="font-size: 5rem;"></i>
                        <h3 class="mt-4 mb-3">Payment Failed</h3>
                        <p class="text-muted">Unfortunately, your payment could not be processed or was canceled.</p>

                        @if (isset($order))
                            <div class="bg-light rounded p-3 my-4">
                                <p class="mb-1"><strong>Order Number:</strong> {{ $order->order_number }}</p>
                                <p class="mb-1"><strong>Transaction ID:</strong> {{ $order->transaction_id }}</p>
                            </div>
                        @endif

                        <div class="mt-4 d-flex justify-content-center gap-3">
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
