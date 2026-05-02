<div class="bg-white shadow-sm rounded p-4">
    <h5 class="fw-bold mb-4"><i class="bi bi-credit-card me-2"></i>Payment Method</h5>

    <form action="{{ route('checkout.submit-step', 3) }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <div class="payment-option border rounded p-4 {{ old('payment_method', $checkoutData['payment_method'] ?? 'cod') === 'cod' ? 'border-primary' : '' }}">
                    <input type="radio" name="payment_method" id="cod" value="cod" class="form-check-input me-2" {{ old('payment_method', $checkoutData['payment_method'] ?? 'cod') === 'cod' ? 'checked' : '' }}>
                    <label for="cod" class="form-check-label fw-bold">
                        <i class="bi bi-cash-stack me-1"></i>Cash on Delivery
                    </label>
                    <p class="text-muted small mt-2 mb-0">Pay when you receive your order at your doorstep</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="payment-option border rounded p-4 {{ old('payment_method', $checkoutData['payment_method'] ?? '') === 'online' ? 'border-primary' : '' }}">
                    <input type="radio" name="payment_method" id="online" value="online" class="form-check-input me-2" {{ old('payment_method', $checkoutData['payment_method'] ?? '') === 'online' ? 'checked' : '' }}>
                    <label for="online" class="form-check-label fw-bold">
                        <i class="bi bi-bank me-1"></i>Online Payment
                    </label>
                    <p class="text-muted small mt-2 mb-0">Pay securely with Credit/Debit Card</p>
                </div>
            </div>
        </div>
        @error('payment_method')
            <div class="text-danger small mt-2">{{ $message }}</div>
        @enderror

        <div class="d-flex gap-3 mt-4">
            <a href="{{ route('checkout.step', 2) }}" class="btn btn-outline-custom">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
            <button type="submit" class="btn btn-primary-custom flex-grow-1">
                Review Order <i class="bi bi-arrow-right ms-2"></i>
            </button>
        </div>
    </form>
</div>

@push('page_scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentOptions = document.querySelectorAll('.payment-option');
        paymentOptions.forEach(option => {
            option.addEventListener('click', function() {
                const radio = this.querySelector('input[type="radio"]');
                radio.checked = true;
                paymentOptions.forEach(opt => opt.classList.remove('border-primary'));
                this.classList.add('border-primary');
            });
        });
    });
</script>
@endpush
