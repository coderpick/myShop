@extends('layouts.frontend.HomeLayout')

@section('content')
    <section class="auth-wrapper py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-body p-4 p-md-5">
                            <div class="text-center mb-4">
                                <h2 class="fw-bold mb-1">Reset Password</h2>
                                <p class="text-muted">Enter your email to receive a reset link</p>
                            </div>

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label fw-600">Email Address</label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                                        <input type="email" name="email" class="form-control bg-light border-start-0 @error('email') is-invalid @enderror" 
                                            placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                                    </div>
                                    @error('email')
                                        <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold py-3 shadow-sm">
                                    Send Reset Link <i class="bi bi-send ms-2"></i>
                                </button>
                            </form>

                            <div class="text-center mt-5">
                                <p class="text-muted mb-0">Remembered your password? 
                                    <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Sign In</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
