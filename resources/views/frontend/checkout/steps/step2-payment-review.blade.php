<div class="bg-white shadow-sm rounded p-4">
    <h5 class="fw-bold mb-4"><i class="bi bi-credit-card me-2"></i>Payment Method</h5>

    <form action="{{ route('checkout.submit-step', 2) }}" method="POST" id="checkoutForm">
        @csrf

        <div class="mb-4">
            <div class="payment-option border rounded p-3 mb-2 @if(($checkoutData['payment_method'] ?? '') == 'online') selected @endif">
                <label class="d-flex align-items-center w-100 cursor-pointer mb-0">
                    <input type="radio" name="payment_method" value="online" class="me-3" @if(($checkoutData['payment_method'] ?? '') == 'online') checked @endif>
                    <div>
                        <h6 class="mb-1">Online Payment</h6>
                        <p class="small text-muted mb-0">Pay securely with credit/debit card</p>
                    </div>
                </label>
            </div>

            <div class="payment-option border rounded p-3 @if(($checkoutData['payment_method'] ?? '') == 'cod') selected @endif">
                <label class="d-flex align-items-center w-100 cursor-pointer mb-0">
                    <input type="radio" name="payment_method" value="cod" class="me-3" @if(($checkoutData['payment_method'] ?? '') == 'cod') checked @endif>
                    <div>
                        <h6 class="mb-1">Cash on Delivery</h6>
                        <p class="small text-muted mb-0">Pay when you receive the order</p>
                    </div>
                </label>
            </div>
            @error('payment_method')
                <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror
        </div>

        <hr class="my-4">

        <h5 class="fw-bold mb-3"><i class="bi bi-clipboard-check me-2"></i>Order Review</h5>

        <div class="order-review mb-4">
            @foreach ($cartItems as $item)
                <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset($item['product']->images->first()?->image_path ?? 'assets/frontend/images/placeholder.png') }}"
                            alt="{{ $item['product']->name }}" style="width: 60px; height: 60px; object-fit: cover;" class="rounded me-3">
                        <div>
                            <h6 class="mb-1 fw-bold">{{ $item['product']->name }}</h6>
                            <small class="text-muted">Qty: {{ $item['quantity'] }}</small>
                        </div>
                    </div>
                    <span class="fw-bold">${{ number_format($item['subtotal'], 2) }}</span>
                </div>
            @endforeach
        </div>

        <div class="d-flex gap-3">
            <a href="{{ route('checkout.step', 1) }}" class="btn btn-outline-custom">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>
    </form>
</div>