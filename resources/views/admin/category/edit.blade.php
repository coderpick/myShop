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
            <a href="{{ route('admin.category.index') }}" class="btn btn-warning">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>

        <!-- Product Table -->
        <div class="data-table-wrapper">
            <div class="data-table-header">
                <h6><i class="bi bi-box-seam me-2"></i>Update Category</h6>
            </div>

            <div class="p-4">
                <form action="{{ route('admin.category.update', $category->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Category Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Category Name" value="{{ $category->name ?? old('name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="icon" class="form-label">Category Icon [<small class="text-danger">Use
                                        bootstrap icon class
                                        name
                                        (e.g: bi
                                        bi-laptop)</small>]</label>
                                <input type="text" name="icon" id="icon"
                                    value="{{ $category->icon ?? old('icon') }}" class="form-control">
                                @error('icon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slug" class="form-label">Category Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control"
                                    placeholder="Category Slug" value="{{ $category->slug ?? old('slug') }}">
                                @error('slug')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="d-block" class="form-label">Show on Main Menu</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_show_in_menu" id="yes"
                                        @checked($category->is_show_in_menu == true) value="1">
                                    <label class="form-check-label" for="yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_show_in_menu" id="no"
                                        @checked($category->is_show_in_menu == false) value="0">
                                    <label class="form-check-label" for="no">No</label>
                                </div>
                            </div>
                            @error('is_show_in_menu')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
