@extends('layouts.backend.master')
@section('content')
    <!-- Page Content -->
    <div class="admin-content">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>Sub Category</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Sub Category</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.sub_category.create') }}" class="btn btn-admin-primary">
                <i class="bi bi-plus-lg"></i> Add Sub Category
            </a>
        </div>

        <!-- Product Table -->
        <div class="data-table-wrapper">
            <div class="data-table-header">
                <h6>
                    <i class="bi bi-box-seam me-2"></i>All Sub Categories <span
                        class="badge bg-primary bg-opacity-10 text-primary ms-1">10</span>
                </h6>
            </div>
            <div class="pb-4 px-4">
                @if ($subCategories->count() > 0)
                    <div class="table-responsive">
                        <table class="table admin-table table-bordered" id="dataTable">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Category</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subCategories as $subCategory)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ ucfirst($subCategory->name) }}</td>
                                        <td>
                                            <span class="fst-italic">{{ $subCategory->slug }}</span>
                                        </td>
                                        <td>
                                            {{ ucfirst($subCategory->category->name) ?? '' }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.sub_category.edit', $subCategory->id) }}"
                                                class="btn btn-admin-outline btn-sm">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.sub_category.destroy', $subCategory->id) }}"
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
                                <i class="bi bi-collection text-primary"></i>
                            </div>
                        </div>
                        <h4 class="fw-bold text-dark mb-2">No Sub Categories Found</h4>
                        <p class="text-muted mb-4 mx-auto" style="max-width: 450px;">
                            Start organizing your products by creating sub-categories. This helps
                            customers find what they're looking for more easily.
                        </p>
                        <a href="{{ route('admin.sub_category.create') }}" class="btn btn-admin-primary px-4 py-2">
                            <i class="bi bi-plus-lg me-2"></i>Add Your First Sub Category
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
        if ($('#dataTable').length > 0) {
            new DataTable('#dataTable');
        }
    </script>
@endpush
