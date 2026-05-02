@extends('layouts.frontend.HomeLayout')
@section('pageTitle', 'Cart')

@section('content')
    <!-- ============ BREADCRUMB ============ -->
    <section class="breadcrumb-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house-door"></i> Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cart</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- ============ CART CONTENT ============ -->
    <section class="section-padding">
        <div class="container">
            @if ($cartItems->isEmpty())
                <!-- Empty Cart State -->
                <div class="text-center py-5">
                    <i class="bi bi-cart-x fs-1 text-muted d-block mb-3"></i>
                    <h4 class="text-muted">Your cart is empty</h4>
                    <p class="text-muted">Looks like you haven't added anything to your cart yet.</p>
                    <a href="{{ route('shop') }}" class="btn btn-primary-custom mt-3">
                        <i class="bi bi-bag me-2"></i>Continue Shopping
                    </a>
                </div>
            @else
                <div class="row g-4">
                    <!-- Cart Items Table -->
                    <div class="col-lg-8">
                        <div class="cart-table bg-white shadow-sm rounded p-4">
                            <h4 class="mb-4 fw-bold">Shopping Cart ({{ $cartItems->count() }} items)</h4>
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead>
                                        <tr>
                                            <th style="width: 40%;">Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Subtotal</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartItems as $item)
                                            <tr data-product-id="{{ $item['product']->id }}">
                                                <td>
                                                    <div class="d-flex align-items-center cart-product">
                                                        <a href="{{ route('product.show', $item['product']->slug) }}">
                                                            <img src="{{ asset($item['product']->images->first()?->image_path ?? 'assets/frontend/images/placeholder.png') }}"
                                                                alt="{{ $item['product']->name }}">
                                                        </a>
                                                        <div class="ms-3">
                                                            <a href="{{ route('product.show', $item['product']->slug) }}"
                                                                class="product-name fw-bold text-decoration-none">
                                                                {{ $item['product']->name }}
                                                            </a>
                                                            @if ($item['product']->category)
                                                                <span
                                                                    class="product-variant text-muted small d-block">{{ $item['product']->category->name }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($item['product']->discount_price > 0)
                                                        <span
                                                            class="text-decoration-line-through text-muted small d-block">${{ number_format($item['product']->price, 2) }}</span>
                                                        <span
                                                            class="fw-bold">${{ number_format($item['product']->discount_price, 2) }}</span>
                                                    @else
                                                        <span
                                                            class="fw-bold">${{ number_format($item['product']->price, 2) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="quantity-selector">
                                                        <button>−</button>
                                                        <input type="number" value="{{ $item['quantity'] }}"
                                                            min="1" max="10">
                                                        <button>+</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span
                                                        class="cart-subtotal fw-bold">${{ number_format($item['subtotal'], 2) }}</span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-danger btn-remove-item" title="Remove">
                                                        <i class="bi bi-x-lg"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <a href="{{ route('shop') }}" class="btn btn-outline-custom">
                                    <i class="bi bi-arrow-left me-1"></i> Continue Shopping
                                </a>
                                <button class="btn btn-outline-danger btn-clear-cart">
                                    <i class="bi bi-trash me-1"></i> Clear Cart
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Cart Summary -->
                    <div class="col-lg-4">
                        <div class="cart-summary bg-white shadow-sm rounded p-4">
                            <h5 class="fw-bold mb-4">Cart Summary</h5>
                            <div class="summary-row d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <span>${{ number_format($total, 2) }}</span>
                            </div>
                            <div class="summary-row d-flex justify-content-between mb-2">
                                <span>Shipping</span>
                                @if ($total >= 2000)
                                    <span class="text-success">Free</span>
                                @else
                                    <p class="text-success">60 TK</p>
                                    <br>
                                    <span style="color: green; font-size: 12px; margin-top: 5px;">Order above 2000 Taka
                                        get
                                        free delivery</span>
                                @endif

                            </div>
                            <hr>
                            <div class="summary-row total d-flex justify-content-between fw-bold fs-5 mb-4">
                                <span>Total</span>
                                @if ($total >= 2000)
                                    <span>${{ number_format($total, 2) }}</span>
                                @else
                                    <span>${{ number_format($total + 60, 2) }}</span>
                                @endif

                            </div>
                            <a href="{{ route('checkout.step', 1) }}" class="btn btn-primary-custom w-100 btn-lg">
                                <i class="bi bi-lock me-2"></i>Proceed to Checkout
                            </a>
                            <div class="mt-3 text-center">
                                <small class="text-muted">
                                    <i class="bi bi-shield-check me-1"></i> Secure checkout. All data is encrypted.
                                </small>
                            </div>
                        </div>

                        <!-- Promo Code -->
                        <div class="mt-4 bg-white shadow-sm rounded p-4  cuppon-section">
                            <h6 class="fw-bold mb-3">Have a Promo Code?</h6>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Enter code">
                                <button class="btn btn-outline-custom" type="button">Apply</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
