@extends('layouts.frontend.HomeLayout')
@section('pageTitle', 'Payment')

@section('content')
    <section class="breadcrumb-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house-door"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Cart</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('checkout.step', 1) }}">Checkout</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Payment</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="bg-white shadow-sm rounded p-4">
                        <h5 class="fw-bold mb-4"><i class="bi bi-credit-card me-2"></i>Payment Details</h5>
                        <div class="alert alert-info mb-4">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Demo Mode:</strong> Use any test card details to complete payment.
                        </div>

                        <form action="{{ route('checkout.process-payment', $order->id) }}" method="POST" id="paymentForm">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Card Number <span class="text-danger">*</span></label>
                                    <input type="text" name="card_number" class="form-control" placeholder="1234 5678 9012 3456" maxlength="16" required>
                                    @error('card_number')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Cardholder Name <span class="text-danger">*</span></label>
                                    <input type="text" name="card_name" class="form-control" placeholder="John Doe" required>
                                    @error('card_name')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Expiry Date <span class="text-danger">*</span></label>
                                    <input type="text" name="expiry_date" class="form-control" placeholder="MM/YY" maxlength="5" required>
                                    @error('expiry_date')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">CVV <span class="text-danger">*</span></label>
                                    <input type="text" name="cvv" class="form-control" placeholder="123" maxlength="3" required>
                                    @error('cvv')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary-custom w-100 btn-lg">
                                    <i class="bi bi-lock me-2"></i>Pay ${{ number_format($order->total_price, 2) }}
                                </button>
                            </div>
                        </form>

                        <div class="mt-3 text-center">
                            <small class="text-muted">
                                <i class="bi bi-shield-check me-1"></i> Your payment information is encrypted and secure.
                            </small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="bg-white shadow-sm rounded p-4">
                        <h5 class="fw-bold mb-4">Order Summary</h5>
                        <div class="mb-3 pb-3 border-bottom">
                            <p class="mb-1 text-muted small">Order Number</p>
                            <p class="fw-bold">{{ $order->order_number }}</p>
                        </div>

                        @foreach($order->orderItems as $item)
                            <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset($item->product->images->first()?->image_path ?? 'assets/frontend/images/placeholder.png') }}" alt="{{ $item->product->name }}" style="width: 50px; height: 50px; object-fit: cover;" class="rounded me-3">
                                    <div>
                                        <h6 class="mb-0 small fw-bold">{{ $item->product->name }}</h6>
                                        <small class="text-muted">Qty: {{ $item->quantity }}</small>
                                    </div>
                                </div>
                                <span class="fw-bold">${{ number_format($item->total_price, 2) }}</span>
                            </div>
                        @endforeach

                        <div class="summary-row d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>${{ number_format($order->total_price, 2) }}</span>
                        </div>
                        <div class="summary-row d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span class="text-success">Free</span>
                        </div>
                        <hr>
                        <div class="summary-row total d-flex justify-content-between fw-bold fs-5 mb-4">
                            <span>Total</span>
                            <span>${{ number_format($order->total_price, 2) }}</span>
                        </div>

                        <div class="bg-light rounded p-3">
                            <h6 class="fw-bold mb-2">Shipping To:</h6>
                            <p class="small mb-0">
                                {{ $order->customer_name }}<br>
                                {{ $order->shipping_address }}<br>
                                {{ $order->city }}{{ $order->state ? ', ' . $order->state : '' }}{{ $order->postal_code ? ' - ' . $order->postal_code : '' }}<br>
                                {{ $order->customer_phone }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page_scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cardNumberInput = document.querySelector('input[name="card_number"]');
        const expiryDateInput = document.querySelector('input[name="expiry_date"]');
        const cvvInput = document.querySelector('input[name="cvv"]');

        cardNumberInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '').substring(0, 16);
        });

        expiryDateInput.addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, '').substring(0, 4);
            if (value.length >= 2) {
                value = value.substring(0, 2) + '/' + value.substring(2);
            }
            this.value = value;
        });

        cvvInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '').substring(0, 3);
        });

        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Processing Payment...';
        });
    });
</script>
@endpush
