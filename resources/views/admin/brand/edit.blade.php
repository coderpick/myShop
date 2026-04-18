@extends('layouts.backend.master')
@section('content')
    <!-- Page Content -->
    <div class="admin-content">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>Brand</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Brand</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.brand.index') }}" class="btn btn-warning">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>

        <!-- Product Table -->
        <div class="data-table-wrapper">
            <div class="data-table-header">
                <h6><i class="bi bi-box-seam me-2"></i>Create New Brand</h6>
            </div>

            <div class="p-4">
                <form action="{{ route('admin.brand.update', $brand->id) }}" class="form-horizontal form-bordered') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="name" class="form-label"> Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name"
                                    value="{{ $brand->name ?? old('name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="d-block" class="form-label">Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" @checked($brand->status == true)
                                        name="status" id="Active" value="1">
                                    <label class="form-check-label" for="Active">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" @checked($brand->status == false)
                                        name="status" id="Inactive" value="0">
                                    <label class="form-check-label" for="Inactive">Inactive</label>
                                </div>
                            </div>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>{{-- .col-md-6 end --}}

                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug"
                                    value="{{ $brand->slug ?? old('slug') }}">
                                @error('slug')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="logo" class="form-label">Brand Logo </label>
                                <input type="file" name="logo" id="logo" class="form-control">
                                @error('logo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div id="image-preview">
                                <img width="30px" src="{{ asset($brand->logo) }}" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    {{-- jquery cnd --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush

@push('custom_js')
    <script>
        $(document).ready(function() {
            $('#name').on('keyup', function() {
                var slug = $(this).val();
                slug = slug.toLowerCase();
                slug = slug.replace(/[^a-z0-9-]+/g, '-');
                slug = slug.replace(/-+$/g, '');
                $('#slug').val(slug);
            });
        });
    </script>
@endpush
