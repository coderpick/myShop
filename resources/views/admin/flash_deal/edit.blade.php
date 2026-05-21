@extends('layouts.backend.master')
@section('content')
    <!-- Page Content -->
    <div class="admin-content">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>Flash Deal Products</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Flash Deal Products</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.flash_deal.index') }}" class="btn btn-warning">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>

        <!-- Product Table -->
        <div class="data-table-wrapper">
            <div class="data-table-header">
                <h6><i class="bi bi-box-seam me-2"></i>Create New Flash Deal Product</h6>
            </div>

            <div class="p-4">
                <form action="{{ route('admin.flash_deal.update', $flashDealProduct->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="product_id" class="form-label"> Product <strong class="text-danger">*</strong>
                                </label>
                                <select name="product_id" id="product_id" class="form-select select2">
                                    <option value="">Select Product</option>
                                    @foreach ($products as $product)
                                        <option @selected($product->id == $flashDealProduct->product_id) value="{{ $product->id }}">
                                            {{ $product->name }}</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- start date and end date field  --}}
                            <div class="mb-3">
                                <label for="start_date" class="form-label"> Start Date <strong
                                        class="text-danger">*</strong>
                                </label>
                                <input type="date" name="start_date" id="start_date" class="form-control"
                                    value="{{ old('start_date', $flashDealProduct->start_date) }}">
                                @error('start_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="end_date" class="form-label"> End Date <strong class="text-danger">*</strong>
                                </label>
                                <input type="date" name="end_date" id="end_date" class="form-control"
                                    value="{{ old('end_date', $flashDealProduct->end_date) }}">
                                @error('end_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-center mt-2">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('page_css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
@push('js')
    {{-- jquery cdn --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    {{-- select2 js cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endpush

@push('custom_js')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        flatpickr("#start_date", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });

        flatpickr("#end_date", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });
    </script>
@endpush
