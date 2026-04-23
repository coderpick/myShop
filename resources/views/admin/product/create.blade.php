@extends('layouts.backend.master')
@section('content')
    <!-- Page Content -->
    <div class="admin-content">
        <div class="page-header">
            <div>
                <h1>Add Product</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="products.html">Products</a></li>
                        <li class="breadcrumb-item active">Add Product</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Alert placeholder -->
        <div class="alert alert-success alert-dismissible fade show d-none" role="alert" id="successAlert">
            <i class="bi bi-check-circle-fill me-2"></i>
            <span id="alertMessage">Success!</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>

        <form id="addProductForm" method="post" enctype="multipart/form-data" action="{{ route('admin.product.store') }}">
            @csrf
            <div class="row g-4">
                <!-- Left Column - Main Info -->
                <div class="col-lg-8">
                    <!-- General Information -->
                    <div class="form-card mb-4">
                        <div class="form-title"><i class="bi bi-info-circle"></i> General Information</div>
                        <div class="mb-3">
                            <label class="form-label" for="name">Product Name *</label>
                            <input type="text" class="form-control" name="name" id="name"
                                value="{{ old('name') }}" placeholder="Enter product name" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="slug">Slug</label>
                            <input type="text" class="form-control" name="slug" id="slug"
                                value="{{ old('slug') }}" placeholder="auto-generated-slug">
                            <div class="form-text">Leave empty to auto-generate from product name.</div>
                            @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="short_description">Short Description *</label>
                            <textarea class="form-control" name="short_description" id="short_description" rows="6"
                                placeholder="Write product description..." required>{{ old('short_description') }}</textarea>
                            @error('short_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="description">Long Description *</label>
                            <textarea class="form-control summernote" name="description" id="description" rows="6"
                                placeholder="Write product description..." required>{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Product Images -->
                    <div class="form-card mb-4">
                        <div class="form-title"><i class="bi bi-images"></i> Product Images</div>
                        <div class="upload-zone" id="uploadZone">
                            <input type="file" id="imageUpload" name="images[]" multiple accept="image/*" hidden>
                            <div class="upload-icon"><i class="bi bi-cloud-arrow-up"></i></div>
                            <div class="upload-text">Click to upload or drag and drop</div>
                            <div class="upload-hint">PNG, JPG, WEBP up to 5MB each (Max 6 images)</div>
                        </div>
                        <div class="image-preview-grid" id="imagePreviewGrid">
                            <!-- Preview items populated by JS -->
                        </div>
                        @error('images')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Pricing -->
                    <div class="form-card mb-4">
                        <div class="form-title"><i class="bi bi-currency-dollar"></i> Pricing</div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label" for="price">Regular Price *</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" name="price" id="price"
                                        value="{{ old('price') }}" required>
                                </div>
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="discount">Discount Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" disabled name="discount" id="discount"
                                        value="{{ old('discount') }}">
                                </div>
                                @error('discount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="discount_price">Discount Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" name="discount_price" id="discount_price"
                                        value="{{ old('discount_price') }}">
                                </div>
                                @error('discount_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Inventory -->
                    <div class="form-card">
                        <div class="form-title"><i class="bi bi-archive"></i> Inventory</div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label" for="sku">SKU *</label>
                                <input type="text" class="form-control" name="sku" id="sku"
                                    value="{{ old('sku') }}">
                                @error('sku')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="stock">Stock Quantity *</label>
                                <input type="number" class="form-control" name="stock" id="stock"
                                    value="{{ old('stock') }}" min="0" required>
                                @error('stock')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="low_stock_alert">Low Stock Alert *</label>
                                <input type="number" class="form-control" id="low_stock_alert" name="low_stock_alert"
                                    value="{{ old('low_stock_alert') }}" placeholder="5" min="0" required>
                                @error('low_stock_alert')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Meta Info -->
                <div class="col-lg-4">
                    <!-- Category -->
                    <div class="form-card mb-4">
                        <div class="form-title"><i class="bi bi-tag"></i> Category</div>
                        <div class="mb-3">
                            <label class="form-label" for="category_id">Category *</label>
                            <select class="form-select" name="category_id" id="category_id" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="sub_category_id">Sub-Category</label>
                            <select class="form-select" name="sub_category_id" id="sub_category_id">
                            </select>
                            @error('sub_category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label" for="brand_id">Brand</label>
                            <select class="form-select" name="brand_id" id="brand_id">
                                <option value="">Select Brand</option>
                                @foreach ($brands as $brand)
                                    <option {{ old('brand_id') == $brand->id ? 'selected' : '' }}
                                        value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="form-card mb-4">
                        <div class="form-title"><i class="bi bi-toggle-on"></i> Status</div>
                        <div class="mb-3">
                            <label class="form-label">Product Status</label>
                            <select class="form-select" name="status" id="status">
                                <option {{ old('status') == 'published' ? 'selected' : '' }} value="published">Published
                                </option>
                                <option {{ old('status') == 'draft' ? 'selected' : '' }} value="draft">Draft</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="featured" name="is_featured"
                                {{ old('is_featured') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label small" for="featured">Featured Product</label>

                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="newArrival" name="is_new_arrival"
                                {{ old('is_new_arrival') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label small" for="newArrival">New Arrival</label>

                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="bestSeller" name="is_bestseller"
                                {{ old('is_bestseller') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label small" for="best_seller">Best Seller</label>

                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="popular" name="is_popular"
                                {{ old('is_popular') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label small" for="popular">Popular Product</label>

                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="trending" name="is_trending"
                                {{ old('is_trending') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label small" for="popular">Trending Product</label>

                        </div>                    
                    </div>

                    <!-- Tags -->
                    {{-- <div class="form-card mb-4">
                        <div class="form-title"><i class="bi bi-tags"></i> Tags</div>
                        <input type="text" class="form-control" placeholder="Add tags separated by comma">
                        <div class="form-text">E.g., smartphone, apple, 5g, pro</div>
                        <div class="mt-2 d-flex flex-wrap gap-1">
                            <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1">smartphone <i
                                    class="bi bi-x ms-1" style="cursor:pointer;"></i></span>
                            <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1">apple <i
                                    class="bi bi-x ms-1" style="cursor:pointer;"></i></span>
                            <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1">5g <i class="bi bi-x ms-1"
                                    style="cursor:pointer;"></i></span>
                        </div>
                    </div> --}}

                    <!-- SEO -->
                    <div class="form-card">
                        <div class="form-title"><i class="bi bi-search"></i> SEO</div>
                        <div class="mb-3">
                            <label class="form-label" for="meta_title">Meta Title</label>
                            <input type="text" class="form-control" name="meta_title" id="meta_title"
                                value="{{ old('meta_title') }}" placeholder="SEO title" maxlength="60">
                            <div class="form-text">0/60 characters</div>
                            @error('meta_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="meta_keywords">Meta Keywords</label>
                            <input type="text" class="form-control" name="meta_keywords" id="meta_keywords"
                                value="{{ old('meta_keywords') }}" placeholder="SEO keywords" maxlength="250">
                            <div class="form-text">0/250 characters</div>
                            @error('meta_keywords')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label" for="meta_description">Meta Description</label>
                            <textarea class="form-control" rows="3" placeholder="SEO description" id="meta_description"
                                name="meta_description" maxlength="160">{{ old('meta_description') }}</textarea>
                            <div class="form-text">0/160 characters</div>
                            @error('meta_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3 d-flex justify-content-center">
                <button class="btn btn-admin-primary" type="submit">
                    <i class="bi bi-check-lg me-1"></i> Save Product
                </button>
            </div>
        </form>
    </div>
@endsection

@push('page_css')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/summernote/summernote-bs5.min.css') }}">
@endpush

@push('js')
    {{-- jquery cnd --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/backend/vendor/summernote/summernote-bs5.min.js') }}"></script>
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

            /* enable discount field if price is not empty */
            $('#price').on('keyup', function() {
                if ($(this).val() != '') {
                    $('#discount').prop('disabled', false);
                } else {
                    $('#discount').prop('disabled', true);
                    $('#discount').val('');
                    $('#discount_price').val('');
                }
            });
            /* enable discount field if price is not empty end */

            /* discount calculation start  */
            $('#discount').on('keyup', function() {
                var discount = $(this).val();
                var price = $('#price').val();
                var discountPrice = price - (price * discount / 100);
                $('#discount_price').val(discountPrice);
            });
            /* discount calculation end  */
            /* summernote initialization */
            $('.summernote').summernote({
                height: 300,
                focus: true,
            });
            /* summernote initialization end */

            /* get subcategory by category id start  */
            $("#category_id").on('change', function() {

                let categoryId = $("#category_id").val();

                $.ajax({
                    url: '{{ route('getSubCategories') }}',
                    type: 'GET',
                    data: {
                        category_id: categoryId
                    },
                    success: function(response) {
                        // let subCategories = response.subCategories;
                        // let subCategoryOptions = '<option value="" disabled selected>Select Sub Category</option>';
                        // $.each(subCategories, function(index, subCategory) {
                        //     subCategoryOptions += '<option value="' + subCategory.id +
                        //         '">' + subCategory.name + '</option>';
                        // });
                        $('#sub_category_id').html(response);
                    }
                })

            });
        });
    </script>
@endpush
