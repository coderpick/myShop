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
            <a href="{{ route('admin.slider.index') }}" class="btn btn-warning">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>

        <!-- Product Table -->
        <div class="data-table-wrapper">
            <div class="data-table-header">
                <h6><i class="bi bi-box-seam me-2"></i>Edit Slider</h6>
            </div>

            <div class="p-4">
                <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title" class="form-label"> Title <strong class="text-danger">*</strong>
                                </label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Title"
                                    value="{{ old('title', $slider->title) }}">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="image" class="form-label">Slider Image </label>
                                <input type="file" name="image" id="image" class="form-control">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                {{-- image preview --}}
                                <div class="mt-2">
                                    <img src="{{ asset($slider->image) }}" alt="Slider Image" class="img-fluid"
                                        id="preview" style="max-width: 200px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="link" class="form-label">Link <small class="text-muted">(Add any
                                        product
                                        link or category link
                                        or brand link)</small></label>
                                <input type="text" name="link" id="link" class="form-control" placeholder="Link"
                                    value="{{ old('link', $slider->link) }}">
                                @error('link')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="d-block" class="form-label">Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" @checked($slider->status == 1)
                                        name="status" id="Active" value="1">
                                    <label class="form-check-label" for="Active">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" @checked($slider->status == 0)
                                        name="status" id="Inactive" value="0">
                                    <label class="form-check-label" for="Inactive">Inactive</label>
                                </div>
                            </div>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="text-center mt-2">
                        <button type="submit" class="btn btn-primary">Update Slider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
@endpush

@push('custom_js')
    <script>
        /* image preview */
        $(document).ready(function() {
            $('#image').change(function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endpush
