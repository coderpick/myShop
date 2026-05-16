@extends('layouts.frontend.HomeLayout')

@section('content')
    <section class="auth-wrapper py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-body p-4 p-md-5">
                            <div class="text-center mb-4">
                                <h2 class="fw-bold mb-1">Create Account</h2>
                                <p class="text-muted">Join us for exclusive deals and features</p>
                            </div>

                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                
                                <div class="mb-3">
                                    <label class="form-label fw-600">Full Name</label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                                        <input type="text" name="name" class="form-control bg-light border-start-0 @error('name') is-invalid @enderror" 
                                            placeholder="John Doe" value="{{ old('name') }}" required autofocus>
                                    </div>
                                    @error('name')
                                        <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-600">Email Address</label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                                        <input type="email" name="email" class="form-control bg-light border-start-0 @error('email') is-invalid @enderror" 
                                            placeholder="name@example.com" value="{{ old('email') }}" required>
                                    </div>
                                    @error('email')
                                        <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-600">Password</label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
                                        <input type="password" name="password" id="regPassword" class="form-control bg-light border-start-0 @error('password') is-invalid @enderror" 
                                            placeholder="••••••••" required>
                                        <button class="btn btn-light border border-start-0" type="button" onclick="togglePassword('regPassword', this)">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-600">Confirm Password</label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-shield-lock text-muted"></i></span>
                                        <input type="password" name="password_confirmation" id="confirmPassword" class="form-control bg-light border-start-0" 
                                            placeholder="••••••••" required>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold py-3 shadow-sm">
                                    Sign Up <i class="bi bi-person-plus ms-2"></i>
                                </button>
                            </form>

                            <div class="text-center mt-5">
                                <p class="text-muted mb-0">Already have an account? 
                                    <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Sign In</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }
    </script>

    <style>
        .auth-wrapper {
            background-color: #f8f9fa;
            min-height: 80vh;
            display: flex;
            align-items: center;
        }
        .fw-600 { font-weight: 600; }
        .card { border-radius: 1.25rem; }
        .form-control:focus {
            box-shadow: none;
            border-color: #0d6efd;
        }
        .input-group-text {
            border-radius: 0.75rem 0 0 0.75rem;
        }
        .form-control {
            border-radius: 0 0.75rem 0.75rem 0;
        }
        .btn-primary {
            border-radius: 0.75rem;
            background: linear-gradient(45deg, #0d6efd, #0a58ca);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(45deg, #0a58ca, #084298);
            transform: translateY(-1px);
        }
    </style>
@endsection
