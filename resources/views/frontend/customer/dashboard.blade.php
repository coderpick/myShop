@extends('layouts.frontend.HomeLayout')

@section('content')
    <section class="customer-dashboard py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                <!-- Sidebar Navigation -->
                <div class="col-lg-3">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4 text-center border-bottom">
                            <div class="avatar-circle mx-auto mb-3">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <h5 class="fw-bold mb-1">{{ auth()->user()->name }}</h5>
                            <p class="text-muted small mb-0">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="list-group list-group-flush p-2">
                            <a href="#overview"
                                class="list-group-item list-group-item-action border-0 rounded-3 active mb-1"
                                data-bs-toggle="pill">
                                <i class="bi bi-grid me-2"></i> Overview
                            </a>
                            <a href="#orders" class="list-group-item list-group-item-action border-0 rounded-3 mb-1"
                                data-bs-toggle="pill">
                                <i class="bi bi-bag me-2"></i> My Orders
                            </a>
                            <a href="#profile" class="list-group-item list-group-item-action border-0 rounded-3 mb-1"
                                data-bs-toggle="pill">
                                <i class="bi bi-person me-2"></i> Profile Settings
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit"
                                    class="list-group-item list-group-item-action border-0 rounded-3 text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-lg-9">
                    <div class="tab-content">
                        <!-- Overview Tab -->
                        <div class="tab-pane fade show active" id="overview">
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="icon-box bg-primary bg-opacity-10 text-primary me-3">
                                                    <i class="bi bi-cart-check"></i>
                                                </div>
                                                <h6 class="text-muted mb-0">Total Orders</h6>
                                            </div>
                                            <h3 class="fw-bold mb-0">{{ $totalOrders }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="icon-box bg-success bg-opacity-10 text-success me-3">
                                                    <i class="bi bi-wallet2"></i>
                                                </div>
                                                <h6 class="text-muted mb-0">Total Spent</h6>
                                            </div>
                                            <h3 class="fw-bold mb-0">৳{{ number_format($totalSpent, 2) }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="icon-box bg-warning bg-opacity-10 text-warning me-3">
                                                    <i class="bi bi-clock-history"></i>
                                                </div>
                                                <h6 class="text-muted mb-0">Pending</h6>
                                            </div>
                                            <h3 class="fw-bold mb-0">{{ $pendingOrders }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                                <div class="card-header bg-white p-4 border-0">
                                    <h5 class="fw-bold mb-0">Recent Orders</h5>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="ps-4">Order ID</th>
                                                <th>Date</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th class="text-end pe-4">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($orders as $order)
                                                <tr>
                                                    <td class="ps-4 fw-600">#{{ $order->order_number }}</td>
                                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                                    <td>৳{{ number_format($order->total_price, 2) }}</td>
                                                    <td>
                                                        <span
                                                            class="badge {{ $order->status->badge() }} bg-opacity-10 {{ $order->status->text() }}">
                                                            {{ strtoupper($order->status->value) }}
                                                        </span>
                                                    </td>
                                                    <td class="text-end pe-4">
                                                        <a href="{{ route('customer.order.details', $order->id) }}"
                                                            class="btn btn-sm btn-outline-primary rounded-pill px-3">View
                                                            Details</a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-5">
                                                        <img src="https://cdn-icons-png.flaticon.com/512/11329/11329061.png"
                                                            width="100" alt="No orders" class="opacity-25 mb-3">
                                                        <p class="text-muted">You haven't placed any orders yet.</p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @if ($orders->count() > 0)
                                    <div class="card-footer bg-white p-4 border-0">
                                        {{ $orders->links() }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Orders Tab -->
                        <div class="tab-pane fade" id="orders">
                            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                                <div class="card-header bg-white p-4 border-0">
                                    <h5 class="fw-bold mb-0">All Orders</h5>
                                </div>
                                <div class="table-responsive">
                                    <!-- Same table as above but for all orders if paginated differently, or just reuse -->
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="ps-4">Order ID</th>
                                                <th>Date</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th class="text-end pe-4">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($orders as $order)
                                                <tr>
                                                    <td class="ps-4 fw-600">#{{ $order->order_number }}</td>
                                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                                    <td>৳{{ number_format($order->total_price, 2) }}</td>
                                                    <td>
                                                        <span
                                                            class="badge {{ $order->status->badge() }} bg-opacity-10 {{ $order->status->text() }}">
                                                            {{ strtoupper($order->status->value) }}
                                                        </span>
                                                    </td>
                                                    <td class="text-end pe-4">
                                                        <a href="{{ route('customer.order.details', $order->id) }}"
                                                            class="btn btn-sm btn-outline-primary rounded-pill px-3">View
                                                            Details</a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-5">No orders found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Tab -->
                        <div class="tab-pane fade" id="profile">
                            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                                <div class="card-header bg-white p-4 border-0">
                                    <h5 class="fw-bold mb-0">Profile Information</h5>
                                </div>
                                <div class="card-body p-4">
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        </div>
                                    @endif

                                    <form action="{{ route('customer.profile.update') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label fw-600">Full Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ auth()->user()->name }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-600">Email Address</label>
                                                <input type="email" name="email" class="form-control"
                                                    value="{{ auth()->user()->email }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-600">Phone Number</label>
                                                <input type="text" name="phone" class="form-control"
                                                    value="{{ auth()->user()->phone ?? '' }}" placeholder="01XXX XXXXXX">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label fw-600">Shipping Address</label>
                                                <textarea name="address" class="form-control" rows="3" placeholder="Enter your full address">{{ auth()->user()->address ?? '' }}</textarea>
                                            </div>
                                            <div class="col-md-12 mt-4">
                                                <button type="submit"
                                                    class="btn btn-primary btn-lg px-5 rounded-pill fw-bold shadow-sm">
                                                    Update Profile
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .fw-600 {
            font-weight: 600;
        }

        .avatar-circle {
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, #0d6efd, #0dcaf0);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: bold;
        }

        .icon-box {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .list-group-item-action.active {
            background-color: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
            font-weight: 600;
        }

        .table thead th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            color: #6c757d;
            border-bottom: none;
        }

        .form-control {
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
        }

        .form-control:focus {
            background-color: #fff;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.05);
            border-color: #0d6efd;
        }
    </style>
@endsection
