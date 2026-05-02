<div class="bg-white shadow-sm rounded p-4">
    <h5 class="fw-bold mb-4"><i class="bi bi-clipboard-check me-2"></i>Review Your Order</h5>

    <div class="mb-4">
        <h6 class="fw-bold mb-2">Customer Information</h6>
        <div class="bg-light rounded p-3">
            <div class="row g-2">
                <div class="col-6">
                    <span class="text-muted small">Name:</span>
                    <p class="mb-0 fw-bold">{{ $checkoutData['name'] ?? ($user?->name ?? '') }}</p>
                </div>
                <div class="col-6">
                    <span class="text-muted small">Email:</span>
                    <p class="mb-0 fw-bold">{{ $checkoutData['email'] ?? ($user?->email ?? '') }}</p>
                </div>
                <div class="col-12">
                    <span class="text-muted small">Phone:</span>
                    <p class="mb-0 fw-bold">{{ $checkoutData['phone'] ?? ($user?->phone ?? '') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-4">
        <h6 class="fw-bold mb-2">Shipping Address</h6>
        <div class="bg-light rounded p-3">
            <p class="mb-0">{{ $checkoutData['shipping_address'] ?? '' }}</p>
            <p class="mb-0">{{ $checkoutData['city'] ?? '' }}{{ $checkoutData['state'] ? ', ' . $checkoutData['state'] : '' }}{{ $checkoutData['postal_code'] ? ' - ' . $checkoutData['postal_code'] : '' }}</p>
            @if(!empty($checkoutData['notes']))
                <hr class="my-2">
                <p class="mb-0 small text-muted"><strong>Notes:</strong> {{ $checkoutData['notes'] }}</p>
            @endif
        </div>
    </div>

    <div class="mb-4">
        <h6 class="fw-bold mb-2">Payment Method</h6>
        <div class="bg-light rounded p-3">
            @if(($checkoutData['payment_method'] ?? 'cod') === 'online')
                <i class="bi bi-bank me-1"></i> Online Payment (Credit/Debit Card)
            @else
                <i class="bi bi-cash-stack me-1"></i> Cash on Delivery
            @endif
        </div>
    </div>

    <div class="mb-4">
        <h6 class="fw-bold mb-2">Order Items</h6>
        <div class="bg-light rounded p-3">
            @foreach($cartItems as $item)
                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset($item['product']->images->first()?->image_path ?? 'assets/frontend/images/placeholder.png') }}" alt="{{ $item['product']->name }}" style="width: 40px; height: 40px; object-fit: cover;" class="rounded me-3">
                        <div>
                            <h6 class="mb-0 small fw-bold">{{ $item['product']->name }}</h6>
                            <small class="text-muted">Qty: {{ $item['quantity'] }}</small>
                        </div>
                    </div>
                    <span class="fw-bold">${{ number_format($item['subtotal'], 2) }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <form action="{{ route('checkout.place-order') }}" method="POST">
        @csrf
        <input type="hidden" name="customer_name" value="{{ $checkoutData['name'] ?? ($user?->name ?? '') }}">
        <input type="hidden" name="customer_email" value="{{ $checkoutData['email'] ?? ($user?->email ?? '') }}">
        <input type="hidden" name="customer_phone" value="{{ $checkoutData['phone'] ?? ($user?->phone ?? '') }}">
        <input type="hidden" name="shipping_address" value="{{ $checkoutData['shipping_address'] ?? '' }}">
        <input type="hidden" name="city" value="{{ $checkoutData['city'] ?? '' }}">
        <input type="hidden" name="state" value="{{ $checkoutData['state'] ?? '' }}">
        <input type="hidden" name="postal_code" value="{{ $checkoutData['postal_code'] ?? '' }}">
        <input type="hidden" name="payment_method" value="{{ $checkoutData['payment_method'] ?? 'cod' }}">
        <input type="hidden" name="notes" value="{{ $checkoutData['notes'] ?? '' }}">

        <div class="d-flex gap-3 mt-4">
            <a href="{{ route('checkout.step', 3) }}" class="btn btn-outline-custom">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
            <button type="submit" class="btn btn-primary-custom flex-grow-1 btn-lg">
                <i class="bi bi-lock me-2"></i>Place Order
            </button>
        </div>
    </form>

    <div class="mt-3 text-center">
        <small class="text-muted">
            <i class="bi bi-shield-check me-1"></i> Secure checkout. All data is encrypted.
        </small>
    </div>
</div>
