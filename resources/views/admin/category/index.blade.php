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
                            @forelse ($categories as $category)
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
                                        <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST"
                                            class="d-inline">
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
                                    <td colspan="6" class="text-center">No Category Found</td>
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
