@extends('layouts.backend.master')
@section('content')
    <div class="admin-content">
        <div class="page-header">
            <div>
                <h1>Customers</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Customers</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="data-table-wrapper">
            <div class="data-table-header">
                <h6><i class="bi bi-people me-2"></i>All Customers</h6>
            </div>
            <div class="table-responsive">
                <table class="table admin-table">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Contact</th>
                            <th>Location</th>
                            <th>Orders</th>
                            <th>Registered At</th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($customers as $customer)
                            <tr>
                                <td>
                                    <div class="customer-cell">
                                        <div class="customer-avatar {{ ['', 'green', 'orange', 'blue', 'red'][rand(0, 4)] }}">
                                            {{ substr($customer->name ?? 'C', 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="customer-name">{{ $customer->name }}</div>
                                            <div class="customer-email small text-muted">{{ $customer->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="small">{{ $customer->phone ?? 'N/A' }}</div>
                                </td>
                                <td>
                                    <div class="small">{{ $customer->city ?? 'N/A' }}</div>
                                </td>
                                <td>
                                    <span class="badge bg-primary bg-opacity-10 text-primary">
                                        {{ $customer->orders_count }} Orders
                                    </span>
                                </td>
                                <td>
                                    <div class="small text-muted">{{ $customer->created_at->format('d M, Y') }}</div>
                                </td>
                                <td>
                                    @if ($customer->status == 'active')
                                        <span class="badge bg-success bg-opacity-10 text-success">Active</span>
                                    @else
                                        <span class="badge bg-danger bg-opacity-10 text-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <a href="{{ route('admin.customer.show', $customer->id) }}" class="action-btn" title="View"><i class="bi bi-eye"></i></a>
                                        <form action="{{ route('admin.customer.destroy', $customer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this customer? This will also delete all their orders.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn text-danger border-0 bg-transparent" title="Delete"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">No customers found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
