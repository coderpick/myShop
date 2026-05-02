<div class="bg-white shadow-sm rounded p-4">
    <div class="accordion" id="checkoutAccordion">
        <!-- Customer Information Accordion -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="customerInfoHeading">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#customerInfoCollapse" aria-expanded="true" aria-controls="customerInfoCollapse">
                    <i class="bi bi-person me-2"></i> Customer Information
                </button>
            </h2>
            <div id="customerInfoCollapse" class="accordion-collapse collapse show" aria-labelledby="customerInfoHeading" data-bs-parent="#checkoutAccordion">
                <div class="accordion-body">
                    @auth
                        <div class="alert alert-info mb-3">
                            <i class="bi bi-check-circle me-2"></i>
                            Logged in as <strong>{{ Auth::user()->name }}</strong>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="{{ Auth::user()->email }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->phone ?? 'Not set' }}" disabled>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('logout') }}" class="btn btn-sm btn-outline-danger">Logout</a>
                        </div>
                    @else
                        <form id="loginForm">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary-custom w-100 mt-3">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login
                            </button>
                            <div class="text-center mt-3">
                                <p class="mb-0">Don't have an account?
                                    <a href="{{ route('register') }}" class="text-decoration-none">Register here</a>
                                </p>
                            </div>
                        </form>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Shipping Information Accordion -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="shippingInfoHeading">
                <button class="accordion-button @if(!Auth::check()) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#shippingInfoCollapse" aria-expanded="@if(Auth::check()) true @else false @endif" aria-controls="shippingInfoCollapse">
                    <i class="bi bi-truck me-2"></i> Shipping Information
                </button>
            </h2>
            <div id="shippingInfoCollapse" class="accordion-collapse collapse @if(Auth::check()) show @endif" aria-labelledby="shippingInfoHeading" data-bs-parent="#checkoutAccordion">
                <div class="accordion-body">
                    <form action="{{ route('checkout.submit-step', 1) }}" method="POST" id="shippingForm">
                        @csrf

                        @unless (Auth::check())
                            <div class="row g-3 mb-4">
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
                        @endunless

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
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Postal Code</label>
                                <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', $checkoutData['postal_code'] ?? '') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Order Notes (Optional)</label>
                                <textarea name="notes" class="form-control" rows="2" placeholder="Any special instructions...">{{ old('notes', $checkoutData['notes'] ?? '') }}</textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('page_scripts')
<script>
$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();

        var $btn = $(this).find('button[type="submit"]');
        var originalText = $btn.html();
        $btn.html('<span class="spinner-border spinner-border-sm me-2"></span> Logging in...').prop('disabled', true);

        $.ajax({
            url: '{{ route("login") }}',
            type: 'POST',
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                window.location.href = '{{ route("checkout.step", 1) }}';
            },
            error: function(xhr) {
                $btn.html(originalText).prop('disabled', false);
                showToastMsg(xhr.responseJSON?.message || 'Login failed! Please check your credentials.');
            }
        });
    });
});
</script>
@endpush
