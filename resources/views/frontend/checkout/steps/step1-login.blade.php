<div class="bg-white shadow-sm rounded p-4">
    <h5 class="fw-bold mb-4"><i class="bi bi-person me-2"></i>Account Information</h5>

    @auth
        <div class="alert alert-info mb-4">
            <i class="bi bi-info-circle me-2"></i>
            Logged in as <strong>{{ Auth::user()->name }}</strong>
        </div>
        <form action="{{ route('checkout.submit-step', 1) }}" method="POST">
            @csrf
            <input type="hidden" name="name" value="{{ Auth::user()->name }}">
            <input type="hidden" name="email" value="{{ Auth::user()->email }}">
            <input type="hidden" name="phone" value="{{ Auth::user()->phone ?? '' }}">
            <button type="submit" class="btn btn-primary-custom w-100 btn-lg">
                Continue to Shipping <i class="bi bi-arrow-right ms-2"></i>
            </button>
        </form>
    @else
        <div class="row g-4">
            <div class="col-12">
                <div class="border rounded p-4 mb-4">
                    <h6 class="fw-bold mb-3">New Customer? Create an account for faster checkout</h6>
                    <p class="text-muted small mb-3">Already have an account? <a href="{{ route('login') }}" class="text-decoration-none">Login here</a></p>
                </div>
            </div>
        </div>

        <form action="{{ route('checkout.submit-step', 1) }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $checkoutData['name'] ?? '') }}" required>
                    @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $checkoutData['email'] ?? '') }}" required>
                    @error('email')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone <span class="text-danger">*</span></label>
                    <input type="tel" name="phone" class="form-control" value="{{ old('phone', $checkoutData['phone'] ?? '') }}" required>
                    @error('phone')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary-custom w-100 btn-lg mt-4">
                Continue to Shipping <i class="bi bi-arrow-right ms-2"></i>
            </button>
        </form>
    @endauth
</div>
