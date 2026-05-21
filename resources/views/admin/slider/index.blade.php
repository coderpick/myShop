@extends('layouts.backend.master')
@section('content')
    <!-- Page Content -->
    <div class="admin-content">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>Slider</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Slider</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.slider.create') }}" class="btn btn-admin-primary">
                <i class="bi bi-plus-lg"></i> Add Slider
            </a>
        </div>

        <!-- Product Table -->
        <div class="data-table-wrapper">
            <div class="data-table-header">
                <h6>
                    <i class="bi bi-box-seam me-2"></i>All Sliders <span
                        class="badge bg-primary bg-opacity-10 text-primary ms-1">{{ $sliders->count() }}</span>
                </h6>
            </div>
            <div class="pb-4 px-4">
                <div class="table-responsive">
                    <table class="table admin-table table-bordered" id="Brand">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Link</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sliders as $slider)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->link }}</td>
                                    <td>
                                        <img style="width:100px;height:80;border-radius: 4px"
                                            src="{{ asset($slider->image) }}" alt="">
                                    </td>
                                    <td>
                                        @if ($slider->status == true)
                                            <span class="badge text-bg-success">Active</span>
                                        @else
                                            <span class="badge text-bg-danger">Inactive</span>
                                        @endif

                                    </td>
                                    <td>
                                        <a href="{{ route('admin.slider.edit', $slider->id) }}"
                                            class="btn btn-admin-outline btn-sm">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.slider.destroy', $slider->id) }}" method="POST"
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
        new DataTable('#Brand');
    </script>
@endpush
