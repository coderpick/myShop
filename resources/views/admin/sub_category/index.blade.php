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
                <div class="table-responsive">
                    <table class="table admin-table table-bordered" id="category">
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
                            @forelse ($subCategories as $subCategory)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $subCategory->name }}</td>
                                    <td>
                                        <span class="fst-italic">{{ $subCategory->slug }}</span>
                                    </td>
                                    <td>
                                        {{ $subCategory->category->name ?? '' }}
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
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No Sub Category Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.bootstrap5.css">
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.bootstrap5.js"></script>
@endpush
@push('custom_js')
    <script>
        new DataTable('#category');
    </script>
@endpush
