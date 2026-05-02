@extends('layouts.frontend.HomeLayout')

@section('content')
    <!-- ============ AUTH CONTAINER ============ -->
    <section class="auth-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9">
                    <div class="auth-card">
                        <div class="row g-0">
                            <!-- Sidebar -->
                            <div class="col-lg-5 d-none d-lg-flex">
                                <div class="auth-sidebar w-100">
                                    <div>
                                        <h2>Welcome to ElectroMart</h2>
                                        <p>Your one-stop destination for the latest electronics, gadgets, and tech
                                            accessories at unbeatable prices.</p>
                                        <ul class="list-unstyled">
                                            <li class="mb-3 d-flex align-items-center">
                                                <i class="bi bi-check-circle-fill me-2"></i>
                                                <span>Exclusive member deals & offers</span>
                                            </li>
                                            <li class="mb-3 d-flex align-items-center">
                                                <i class="bi bi-check-circle-fill me-2"></i>
                                                <span>Track orders & manage returns</span>
                                            </li>
                                            <li class="mb-3 d-flex align-items-center">
                                                <i class="bi bi-check-circle-fill me-2"></i>
                                                <span>Save items to your wishlist</span>
                                            </li>
                                            <li class="mb-3 d-flex align-items-center">
                                                <i class="bi bi-check-circle-fill me-2"></i>
                                                <span>Faster checkout experience</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Auth Form -->
                            <div class="col-lg-7">
                                <div class="auth-form">
                                    <!-- Tab Navigation -->
                                    <ul class="nav nav-pills mb-4" id="authTab" role="tablist">
                                        <li class="nav-item flex-fill" role="presentation">
                                            <button class="nav-link active w-100 fw-bold" id="login-tab" data-bs-toggle="pill"
                                                data-bs-target="#loginTab" type="button">Login</button>
                                        </li>
                                        <li class="nav-item flex-fill" role="presentation">
                                            <button class="nav-link w-100 fw-bold" id="register-tab" data-bs-toggle="pill"
                                                data-bs-target="#registerTab" type="button">Register</button>
                                        </li>
                                    </ul>

                                    @if(session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        </div>
                                    @endif

                                    <div class="tab-content" id="authTabContent">
                                        <!-- ===== LOGIN TAB ===== -->
                                        <div class="tab-pane fade show active" id="loginTab">
                                            <h3>Welcome Back!</h3>
                                            <p class="subtitle">Login to access your account</p>

                                            <!-- Social Login -->
                                            <div class="social-login">
                                                <button class="btn" type="button">
                                                    <i class="bi bi-google text-danger"></i> Google
                                                </button>
                                                <button class="btn" type="button">
                                                    <i class="bi bi-facebook text-primary"></i> Facebook
                                                </button>
                                                <button class="btn" type="button">
                                                    <i class="bi bi-apple"></i> Apple
                                                </button>
                                            </div>

                                            <div class="divider">or login with email</div>

                                            <form method="POST" action="{{ route('login') }}">
                                                @csrf
                                                <div class="form-floating-custom">
                                                    <label class="form-label fw-bold small">Email Address</label>
                                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email" value="{{ old('email') }}" required autofocus>
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-floating-custom mt-3">
                                                    <label class="form-label fw-bold small">Password</label>
                                                    <div class="input-group">
                                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" id="loginPassword" required>
                                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('loginPassword', this)">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                        @error('password')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center mb-3 mt-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                                                        <label class="form-check-label small" for="rememberMe">Remember me</label>
                                                    </div>
                                                    @if (Route::has('password.request'))
                                                        <a href="{{ route('password.request') }}" class="small text-primary">Forgot Password?</a>
                                                    @endif
                                                </div>
                                                <button type="submit" class="btn btn-primary-custom w-100 btn-lg">
                                                    <i class="bi bi-box-arrow-in-right me-2"></i> Login
                                                </button>
                                            </form>
                                        </div>

                                        <!-- ===== REGISTER TAB ===== -->
                                        <div class="tab-pane fade" id="registerTab">
                                            <h3>Create Account</h3>
                                            <p class="subtitle">Join ElectroMart for exclusive benefits</p>

                                            <!-- Social Login -->
                                            <div class="social-login">
                                                <button class="btn" type="button">
                                                    <i class="bi bi-google text-danger"></i> Google
                                                </button>
                                                <button class="btn" type="button">
                                                    <i class="bi bi-facebook text-primary"></i> Facebook
                                                </button>
                                                <button class="btn" type="button">
                                                    <i class="bi bi-apple"></i> Apple
                                                </button>
                                            </div>

                                            <div class="divider">or register with email</div>

                                            <form method="POST" action="{{ route('register') }}">
                                                @csrf
                                                <div class="form-floating-custom">
                                                    <label class="form-label fw-bold small">Full Name</label>
                                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="John Doe" value="{{ old('name') }}" required>
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-floating-custom mt-3">
                                                    <label class="form-label fw-bold small">Email Address</label>
                                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="john@example.com" value="{{ old('email') }}" required>
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-floating-custom mt-3">
                                                    <label class="form-label fw-bold small">Password</label>
                                                    <div class="input-group">
                                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Create a password" id="registerPassword" required>
                                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('registerPassword', this)">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                        @error('password')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-text small">Must be at least 8 characters</div>
                                                </div>
                                                <div class="form-floating-custom mt-3">
                                                    <label class="form-label fw-bold small">Confirm Password</label>
                                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your password" required>
                                                </div>
                                                <div class="form-check mb-3 mt-3">
                                                    <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                                                    <label class="form-check-label small" for="agreeTerms">
                                                        I agree to the <a href="#" class="text-primary">Terms of Service</a> and <a href="#" class="text-primary">Privacy Policy</a>
                                                    </label>
                                                </div>
                                                <button type="submit" class="btn btn-primary-custom w-100 btn-lg">
                                                    <i class="bi bi-person-plus me-2"></i> Create Account
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($errors->any() && (old('name') || old('password_confirmation')))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var registerTab = document.getElementById('register-tab');
                var tab = new bootstrap.Tab(registerTab);
                tab.show();
            });
        </script>
    @endif
@endsection
