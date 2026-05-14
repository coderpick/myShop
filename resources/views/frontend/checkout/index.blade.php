@extends('layouts.frontend.HomeLayout')
@section('pageTitle', 'Cart')

@section('content')
    <!-- ============ BREADCRUMB ============ -->
    <section class="breadcrumb-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house-door"></i> Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- ============ CHECKOUT SECTION ============ -->
    <div class="bg-white shadow-sm rounded p-4">
        <div class="container">
            <form action="{{ route('checkout.store') }}" method="POST" id="shippingForm">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-3"><i class="bi bi-person me-2"></i>Billing
                                    information</h5>
                                <div class="row g-3">

                                    <div class="col-md-6">
                                        <label class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $user?->name ?? old('name') }}" required>
                                        @error('name')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                        <input type="tel" name="phone" class="form-control"
                                            value="{{ $user?->phone ?? old('phone') }}" required>
                                        @error('phone')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ $user?->email ?? old('email') }}" required>
                                        @error('email')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">City <span class="text-danger">*</span></label>
                                        <input type="text" name="city" class="form-control"
                                            value="{{ $user?->city ?? old('city') }}" required>
                                        @error('city')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Post Code</label>
                                        <input type="text" name="postal_code" class="form-control"
                                            value="{{ $user?->postal_code ?? old('postal_code') }}">
                                        @error('city')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Address <span class="text-danger">*</span></label>
                                        <textarea name="address" class="form-control" rows="3" required>{{ $user?->address ?? old('address') }}</textarea>
                                        @error('address')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Order Notes (Optional)</label>
                                        <textarea name="notes" class="form-control" rows="2" placeholder="Any special instructions...">{{ old('notes', $checkoutData['notes'] ?? '') }}</textarea>
                                    </div>
                                </div>

                                {{-- payment information --}}
                                <div class="row g-3 mt-3">
                                    <div class="col-md-6">
                                        <div
                                            class="payment-option border rounded p-4 {{ old('payment_method', $checkoutData['payment_method'] ?? 'cod') === 'cod' ? 'border-primary' : '' }}">
                                            <input type="radio" name="payment_method" id="cod" value="cod"
                                                class="form-check-input me-2"
                                                {{ old('payment_method', $checkoutData['payment_method'] ?? 'cod') === 'cod' ? 'checked' : '' }}>
                                            <label for="cod" class="form-check-label fw-bold">
                                                <i class="bi bi-cash-stack me-1"></i>Cash on Delivery
                                            </label>
                                            <p class="text-muted small mt-2 mb-0">Pay when you receive your order at your
                                                doorstep</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div
                                            class="payment-option border rounded p-4 {{ old('payment_method', $checkoutData['payment_method'] ?? '') === 'online' ? 'border-primary' : '' }}">
                                            <input type="radio" name="payment_method" id="online" value="online"
                                                class="form-check-input me-2"
                                                {{ old('payment_method', $checkoutData['payment_method'] ?? '') === 'online' ? 'checked' : '' }}>
                                            <label for="online" class="form-check-label fw-bold">
                                                <i class="bi bi-bank me-1"></i>SSLCommerz (Online Payment)
                                            </label>
                                            <p class="text-muted small mt-2 mb-0">Pay securely with SSLCommerz</p>
                                        </div>
                                    </div>

                                    @error('payment_method')
                                        <div class="text-danger small mt-2">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="d-flex gap-3 mt-4">
                                    <a href="{{ route('cart.index') }}" class="btn btn-outline-custom">
                                        <i class="bi bi-arrow-left me-1"></i> Back to Cart
                                    </a>
                                    @if (!Auth::check())
                                        <button type="button" class="btn btn-primary-custom flex-grow-1 btn-lg"
                                            data-bs-toggle="modal" data-bs-target="#loginModal">
                                            <i class="bi bi-lock me-2"></i>Place Order
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-primary-custom flex-grow-1 btn-lg">
                                            <i class="bi bi-lock me-2"></i>Place Order
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
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
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- login modal start --}}

    <!-- Modal -->
    <div class="modal fade quick-view-modal" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" id="loginForm">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Login</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                aria-describedby="emailHelp">
                            <span id="email_error" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                aria-describedby="passwordHelp">
                            <span id="password_error" class="text-danger"></span>
                        </div>
                        {{-- registration link --}}
                        <p class="mb-0">Don't have an account? <a href="javascript:void(0)" class="text-primary"
                                data-bs-toggle="modal" data-bs-target="#registerModal">Register</a></p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- login modal end --}}

    {{-- register modal start --}}
    <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Registration</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registerForm" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                aria-describedby="nameHelp">
                            <span id="reg_name_error" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                aria-describedby="emailHelp">
                            <span id="reg_email_error" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                aria-describedby="passwordHelp">
                            <span id="reg_password_error" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" aria-describedby="passwordConfirmationHelp">
                            <span id="reg_password_confirmation_error" class="text-danger"></span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0">Already have an account? <a href="javascript:void(0)" class="text-primary"
                                    data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></p>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- register modal end --}}
@endsection

@push('page_scripts')
    <script>
        $(document).ready(function() {

            $('#loginForm').on('submit', function(e) {
                e.preventDefault();

                var $btn = $(this).find('button[type="submit"]');
                var originalText = $btn.html();
                $btn.html('<span class="spinner-border spinner-border-sm me-2"></span> Logging in...').prop(
                    'disabled', true);

                $.ajax({
                    url: '{{ route('login') }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        window.location.href = '{{ route('checkout.index') }}';
                        showToastMsg('Login successful!');
                        $("#email_error").text('');
                        $("#password_error").text('');
                    },
                    error: function(xhr) {
                        $btn.html(originalText).prop('disabled', false);

                        $('#email_error').text(xhr.responseJSON?.errors?.email);
                        $('#password_error').text(xhr.responseJSON?.errors?.password);

                    }
                });
            });

            // register

            $('#registerForm').on('submit', function(e) {
                e.preventDefault();

                var $btn = $(this).find('button[type="submit"]');
                var originalText = $btn.html();
                $btn.html('<span class="spinner-border spinner-border-sm me-2"></span> Registering...')
                    .prop(
                        'disabled', true);

                $.ajax({
                    url: '{{ route('register') }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        window.location.href = '{{ route('checkout.index') }}';
                        showToastMsg('Registration successful!');
                        $("#reg_name_error").text('');
                        $("#reg_email_error").text('');
                        $("#reg_password_error").text('');
                        $("#reg_password_confirmation_error").text('');
                    },
                    error: function(xhr) {
                        $btn.html(originalText).prop('disabled', false);
                        $('#reg_name_error').text(xhr.responseJSON?.errors?.name);
                        $('#reg_email_error').text(xhr.responseJSON?.errors?.email);
                        $('#reg_password_error').text(xhr.responseJSON?.errors?.password);
                        $('#reg_password_confirmation_error').text(xhr.responseJSON?.errors
                            ?.password_confirmation);
                    }
                });
            });
        });
    </script>
@endpush
