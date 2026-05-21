@extends('layouts.backend.master')
@section('content')
    <!-- Page Content -->
    <div class="admin-content">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>Flash Deals</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Flash Deals</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.flash_deal.create') }}" class="btn btn-admin-primary">
                <i class="bi bi-plus-lg"></i> Add Flash Deals
            </a>
        </div>

        <!-- Product Table -->
        <div class="data-table-wrapper">
            <div class="data-table-header">
                <h6>
                    <i class="bi bi-box-seam me-2"></i>All Flash Deals <span
                        class="badge bg-primary bg-opacity-10 text-primary ms-1">{{ $flashDealProducts->count() }}</span>
                </h6>
            </div>
            <div class="pb-4 px-4">
                <div class="table-responsive">
                    <table class="table admin-table table-bordered" id="Brand">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Product Name</th>
                                <th>Image</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($flashDealProducts as $flashDealProduct)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $flashDealProduct->product?->name }}</td>
                                    <td>
                                        <img style="width:100px;height:80;border-radius: 4px"
                                            src="{{ asset($flashDealProduct->product?->images->first()->image_path) }}"
                                            alt="">
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($flashDealProduct->start_date)->format('F d, Y h:i A') }}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($flashDealProduct->end_date)->format('F d, Y h:i A') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.flash_deal.edit', $flashDealProduct->id) }}"
                                            class="btn btn-admin-outline btn-sm">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.flash_deal.destroy', $flashDealProduct->id) }}"
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
