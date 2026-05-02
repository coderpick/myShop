@extends('layouts.frontend.HomeLayout')
@section('pageTitle', 'Checkout')

@section('content')
    <section class="breadcrumb-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house-door"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Cart</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="section-padding bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="checkout-steps mb-4">
                        <div class="step {{ $currentStep >= 1 ? 'active' : '' }} {{ $currentStep > 1 ? 'completed' : '' }}">
                            <div class="step-icon">
                                @if ($currentStep > 1)
                                    <i class="bi bi-check-lg"></i>
                                @else
                                    <span>1</span>
                                @endif
                            </div>
                            <span class="step-label">Information</span>
                        </div>
                        <div class="step-line {{ $currentStep > 1 ? 'active' : '' }}"></div>
                        <div class="step {{ $currentStep >= 2 ? 'active' : '' }}">
                            <div class="step-icon">
                                @if ($currentStep == 2)
                                    <span>2</span>
                                @else
                                    <i class="bi bi-check-lg"></i>
                                @endif
                            </div>
                            <span class="step-label">Payment & Review</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row g-4">
                <div class="col-lg-8">
                    @if ($currentStep == 1)
                        @include('frontend.checkout.steps.step1-information')
                    @elseif($currentStep == 2)
                        @include('frontend.checkout.steps.step2-payment-review')
                    @endif
                </div>

                <div class="col-lg-4">
                    <div class="bg-white shadow-sm rounded p-4 sticky-top" style="top: 100px;">
                        <h5 class="fw-bold mb-4">Order Summary</h5>
                        @foreach ($cartItems as $item)
                            <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset($item['product']->images->first()?->image_path ?? 'assets/frontend/images/placeholder.png') }}"
                                        alt="{{ $item['product']->name }}"
                                        style="width: 50px; height: 50px; object-fit: cover;" class="rounded me-3">
                                    <div>
                                        <h6 class="mb-0 small fw-bold">{{ $item['product']->name }}</h6>
                                        <small class="text-muted">Qty: {{ $item['quantity'] }}</small>
                                    </div>
                                </div>
                                <span class="fw-bold">${{ number_format($item['subtotal'], 2) }}</span>
                            </div>
                        @endforeach

                        <div class="summary-row d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="summary-row d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span class="text-success">Free</span>
                        </div>
                        <hr>
                        <div class="summary-row total d-flex justify-content-between fw-bold fs-5 mb-4">
                            <span>Total</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>

                        @if ($currentStep == 1)
                            <button type="button" class="btn btn-primary-custom w-100 btn-lg" id="continueToPaymentBtn">
                                Continue to Payment <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        @elseif ($currentStep == 2)
                            <form action="{{ route('checkout.submit-step', 2) }}" method="POST" id="placeOrderForm">
                                @csrf
                                <input type="hidden" name="payment_method" id="paymentMethodInput" value="{{ $checkoutData['payment_method'] ?? '' }}">
                                <button type="submit" class="btn btn-primary-custom w-100 btn-lg">
                                    <i class="bi bi-lock me-2"></i>Place Order
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page_scripts')
<script>
$(document).ready(function() {
    // Sync payment method selection
    $('input[name="payment_method"]').on('change', function() {
        $('#paymentMethodInput').val($(this).val());
    });

    // Submit shipping form when Continue to Payment is clicked
    $('#continueToPaymentBtn').on('click', function() {
        // Find the shipping form in the included step file
        var $form = $('form').filter(function() {
            return $(this).attr('action') && $(this).attr('action').includes('checkout.submit-step/1');
        });
        
        if ($form.length) {
            $form.submit();
        } else {
            // Fallback: try to submit the form with id shippingForm
            $('#shippingForm').submit();
        }
    });
});
</script>
@endpush

@push('page_styles')
    <style>
        .checkout-steps {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }

        .checkout-steps .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        .checkout-steps .step-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: #e2e8f0;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .checkout-steps .step.active .step-icon {
            background: #2563eb;
            color: white;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.2);
        }

        .checkout-steps .step.completed .step-icon {
            background: #22c55e;
            color: white;
        }

        .checkout-steps .step-label {
            margin-top: 8px;
            font-size: 0.85rem;
            color: #94a3b8;
            font-weight: 500;
        }

        .checkout-steps .step.active .step-label {
            color: #2563eb;
            font-weight: 600;
        }

        .checkout-steps .step.completed .step-label {
            color: #22c55e;
        }

        .checkout-steps .step-line {
            width: 120px;
            height: 3px;
            background: #e2e8f0;
            margin: 0 10px;
            margin-bottom: 25px;
            transition: all 0.3s ease;
        }

        .checkout-steps .step-line.active {
            background: #22c55e;
        }

        @media (max-width: 768px) {
            .checkout-steps .step-line {
                width: 60px;
                margin: 0 5px;
                margin-bottom: 25px;
            }

            .checkout-steps .step-label {
                font-size: 0.75rem;
            }

            .checkout-steps .step-icon {
                width: 35px;
                height: 35px;
                font-size: 0.9rem;
            }
        }
    </style>
@endpush
