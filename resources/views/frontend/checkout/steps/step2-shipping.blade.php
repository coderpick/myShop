<div class="bg-white shadow-sm rounded p-4">
    <h5 class="fw-bold mb-4"><i class="bi bi-truck me-2"></i>Shipping Information</h5>

    <form action="{{ route('checkout.submit-step', 2) }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label">Shipping Address <span class="text-danger">*</span></label>
                <textarea name="shipping_address" class="form-control" rows="3" required>{{ old('shipping_address', $checkoutData['shipping_address'] ?? ($user?->address ?? '')) }}</textarea>
                @error('shipping_address')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                <input type="tel" name="mobile_number" class="form-control" value="{{ old('mobile_number', $checkoutData['mobile_number'] ?? ($user?->phone ?? '')) }}" required>
                @error('mobile_number')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">City <span class="text-danger">*</span></label>
                <input type="text" name="city" class="form-control" value="{{ old('city', $checkoutData['city'] ?? '') }}" required>
                @error('city')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">State</label>
                <input type="text" name="state" class="form-control" value="{{ old('state', $checkoutData['state'] ?? '') }}">
                @error('state')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Postal Code</label>
                <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', $checkoutData['postal_code'] ?? '') }}">
                @error('postal_code')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <label class="form-label">Order Notes (Optional)</label>
                <textarea name="notes" class="form-control" rows="2" placeholder="Any special instructions for your order...">{{ old('notes', $checkoutData['notes'] ?? '') }}</textarea>
            </div>
        </div>
        <div class="d-flex gap-3 mt-4">
            <a href="{{ route('checkout.step', 1) }}" class="btn btn-outline-custom">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
            <button type="submit" class="btn btn-primary-custom flex-grow-1">
                Continue to Payment <i class="bi bi-arrow-right ms-2"></i>
            </button>
        </div>
    </form>
</div>
