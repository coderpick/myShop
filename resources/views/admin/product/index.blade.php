@extends('layouts.backend.master')
@section('content')
    <!-- Page Content -->
    <div class="admin-content">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>Products</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.product.create') }}" class="btn btn-admin-primary">
                <i class="bi bi-plus-lg"></i> Add Product
            </a>
        </div>

        <!-- Product Table -->
        <div class="data-table-wrapper">
            <div class="data-table-header">
                <h6><i class="bi bi-box-seam me-2"></i>All Products <span
                        class="badge bg-primary bg-opacity-10 text-primary ms-1">{{ $products->count() }}</span></h6>
            </div>

            <div class="table-responsive p-3">
                <table class="table admin-table" id="ProductTable">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    <div class="product-cell">
                                        <img src="{{ asset($product->images->first()->image_path ?? 'assets/backend/images/placeholder.png') }}"
                                            alt="Product"
                                            style="width: 44px; height: 44px; object-fit: cover; border-radius: 4px;">
                                        <div>
                                            <div class="product-name fw-bold">{{ $product->name }}</div>
                                            <div class="product-sku small text-muted">SKU: {{ $product->sku }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-primary bg-opacity-10 text-primary">{{ $product->category->name ?? 'N/A' }}</span>
                                    @if ($product->subCategory)
                                        <br><small class="text-muted">{{ $product->subCategory->name }}</small>
                                    @endif
                                </td>
                                <td>
                                    @if ($product->discount)
                                        <div class="fw-bold">${{ number_format($product->discount_price) }}</div>
                                        <div class="small text-muted text-decoration-line-through">
                                            ${{ number_format($product->price) }}</div>
                                    @else
                                        <div class="fw-bold">${{ number_format($product->price) }}</div>
                                    @endif
                                </td>
                                <td>
                                    <span
                                        class="fw-600 {{ $product->stock <= $product->low_stock_alert ? 'text-danger' : '' }}">
                                        {{ $product->stock }}
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="badge {{ $product->status === 'published' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ ucfirst($product->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <a href="{{ route('admin.product.show', $product->id) }}" class="action-btn"
                                            title="View"><i class="bi bi-eye"></i></a>
                                        <a href="{{ route('admin.product.edit', $product->id) }}" class="action-btn edit"
                                            title="Edit"><i class="bi bi-pencil"></i></a>
                                        <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST"
                                            class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete" title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this product?')">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('page_css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
@endpush

@push('custom_js')
    <script>
        $(document).ready(function() {
            $('#ProductTable').DataTable({
                "order": [
                    [0, "desc"]
                ],
                "pageLength": 10
            });
        });
    </script>
@endpush
