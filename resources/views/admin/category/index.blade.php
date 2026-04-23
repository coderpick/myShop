@extends('layouts.backend.master')
@section('content')
    <!-- Page Content -->
    <div class="admin-content">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>Category</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.category.create') }}" class="btn btn-admin-primary">
                <i class="bi bi-plus-lg"></i> Add Category
            </a>
        </div>

        <!-- Product Table -->
        <div class="data-table-wrapper">
            <div class="data-table-header">
                <h6>
                    <i class="bi bi-box-seam me-2"></i>All Categories <span
                        class="badge bg-primary bg-opacity-10 text-primary ms-1">10</span>
                </h6>
            </div>
            <div class="pb-4 px-4">
                @if ($categories->count() > 0)
                    <div class="table-responsive">
                        <table class="table admin-table table-bordered" id="category">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Icon</th>
                                    <th>Is Menu Show</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <span class="fst-italic">{{ $category->slug }}</span>
                                        </td>
                                        <td>{{ $category->icon }}</td>
                                        <td>
                                            @if ($category->is_show_in_menu == true)
                                                <span class="badge bg-success">Yes</span>
                                            @else
                                                <span class="badge bg-danger">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.category.edit', $category->id) }}"
                                                class="btn btn-admin-outline btn-sm">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.category.destroy', $category->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-admin-outline btn-sm"
                                                    onclick="return confirm('Are you sure to delete?')">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <div class="empty-state-icon mx-auto shadow-sm">
                                <i class="bi bi-tags text-primary"></i>
                            </div>
                        </div>
                        <h4 class="fw-bold text-dark mb-2">No Categories Found</h4>
                        <p class="text-muted mb-4 mx-auto" style="max-width: 450px;">
                            Start by creating your first product category. Categories help you organize your inventory and
                            make browsing easier for customers.
                        </p>
                        <a href="{{ route('admin.category.create') }}" class="btn btn-admin-primary px-4 py-2">
                            <i class="bi bi-plus-lg me-2"></i>Create Your First Category
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('page_css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.bootstrap5.css">
    <style>
        .empty-state-icon {
            width: 80px;
            height: 80px;
            background: var(--admin-primary-bg, rgba(79, 70, 229, 0.1));
            color: var(--admin-primary, #4f46e5);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }
    </style>
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.bootstrap5.js"></script>
@endpush
@push('custom_js')
    <script>
        if ($('#category').length > 0) {
            new DataTable('#category');
        }
    </script>
@endpush
