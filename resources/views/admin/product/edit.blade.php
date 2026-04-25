@extends('layouts.backend.master')
@section('content')
    <!-- Page Content -->
    <div class="admin-content">
        <div class="page-header">
            <div>
                <h1>Edit Product</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Products</a></li>
                        <li class="breadcrumb-item active">Edit Product</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.product.index') }}" class="btn btn-warning">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>

        <form id="editProductForm" method="post" enctype="multipart/form-data" action="{{ route('admin.product.update', $product->id) }}">
            @csrf
            @method('PUT')
            <div class="row g-4">
                <!-- Left Column - Main Info -->
                <div class="col-lg-8">
                    <!-- General Information -->
                    <div class="form-card mb-4">
                        <div class="form-title"><i class="bi bi-info-circle"></i> General Information</div>
                        <div class="mb-3">
                            <label class="form-label" for="name">Product Name *</label>
                            <input type="text" class="form-control" name="name" id="name"
                                value="{{ old('name', $product->name) }}" placeholder="Enter product name" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="slug">Slug</label>
                            <input type="text" class="form-control" name="slug" id="slug"
                                value="{{ old('slug', $product->slug) }}" placeholder="auto-generated-slug">
                            <div class="form-text">Leave empty to auto-generate from product name.</div>
                            @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="short_description">Short Description *</label>
                            <textarea class="form-control" name="short_description" id="short_description" rows="6"
                                placeholder="Write product description..." required>{{ old('short_description', $product->short_description) }}</textarea>
                            @error('short_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="description">Long Description *</label>
                            <textarea class="form-control summernote" name="description" id="description" rows="6"
                                placeholder="Write product description..." required>{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Product Images -->
                    <div class="form-card mb-4">
                        <div class="form-title"><i class="bi bi-images"></i> Product Images</div>
                        
                        <div class="mb-3">
                            <label class="form-label">Existing Images</label>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                @foreach($product->images as $image)
                                    <div class="existing-image-item" id="image-container-{{ $image->id }}">
                                        <img src="{{ asset($image->image_path) }}" alt="Product Image" class="img-thumbnail">
                                        <button type="button" class="remove-image delete-existing-image" data-id="{{ $image->id }}" title="Delete Image">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <input type="file" id="productImageUpload" name="images[]" multiple accept="image/*" hidden>
                        <div class="upload-zone" id="productUploadZone">
                            <div class="upload-icon"><i class="bi bi-cloud-arrow-up"></i></div>
                            <div class="upload-text">Click to upload or drag and drop new images</div>
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
                                        value="{{ old('price', $product->price) }}" required>
                                </div>
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="discount">Discount (%)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="discount" id="discount"
                                        value="{{ old('discount', $product->discount) }}">
                                    <span class="input-group-text">%</span>
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
                                        value="{{ old('discount_price', $product->discount_price) }}">
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
                                    value="{{ old('sku', $product->sku) }}">
                                @error('sku')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="stock">Stock Quantity *</label>
                                <input type="number" class="form-control" name="stock" id="stock"
                                    value="{{ old('stock', $product->stock) }}" min="0" required>
                                @error('stock')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="low_stock_alert">Low Stock Alert *</label>
                                <input type="number" class="form-control" id="low_stock_alert" name="low_stock_alert"
                                    value="{{ old('low_stock_alert', $product->low_stock_alert) }}" placeholder="5" min="0" required>
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
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}
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
                                <option value="">Select Sub-Category</option>
                                @foreach($subCategories as $subCategory)
                                    <option value="{{ $subCategory->id }}" {{ old('sub_category_id', $product->sub_category_id) == $subCategory->id ? 'selected' : '' }}>
                                        {{ $subCategory->name }}
                                    </option>
                                @endforeach
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
                                    <option {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}
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
                                <option {{ old('status', $product->status) == 'published' ? 'selected' : '' }} value="published">Published</option>
                                <option {{ old('status', $product->status) == 'draft' ? 'selected' : '' }} value="draft">Draft</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="featured" name="is_featured"
                                {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label small" for="featured">Featured Product</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="newArrival" name="is_new_arrival"
                                {{ old('is_new_arrival', $product->is_new_arrival) ? 'checked' : '' }}>
                            <label class="form-check-label small" for="newArrival">New Arrival</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="bestSeller" name="is_bestseller"
                                {{ old('is_bestseller', $product->is_bestseller) ? 'checked' : '' }}>
                            <label class="form-check-label small" for="bestSeller">Best Seller</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="popular" name="is_popular"
                                {{ old('is_popular', $product->is_popular) ? 'checked' : '' }}>
                            <label class="form-check-label small" for="popular">Popular Product</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="trending" name="is_trending"
                                {{ old('is_trending', $product->is_trending) ? 'checked' : '' }}>
                            <label class="form-check-label small" for="trending">Trending Product</label>
                        </div>                    
                    </div>

                    <!-- SEO -->
                    <div class="form-card">
                        <div class="form-title"><i class="bi bi-search"></i> SEO</div>
                        <div class="mb-3">
                            <label class="form-label" for="meta_title">Meta Title</label>
                            <input type="text" class="form-control" name="meta_title" id="meta_title"
                                value="{{ old('meta_title', $product->meta_title) }}" placeholder="SEO title" maxlength="60">
                            @error('meta_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="meta_keywords">Meta Keywords</label>
                            <input type="text" class="form-control" name="meta_keywords" id="meta_keywords"
                                value="{{ old('meta_keywords', $product->meta_keywords) }}" placeholder="SEO keywords" maxlength="250">
                            @error('meta_keywords')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label" for="meta_description">Meta Description</label>
                            <textarea class="form-control" rows="3" placeholder="SEO description" id="meta_description"
                                name="meta_description" maxlength="160">{{ old('meta_description', $product->meta_description) }}</textarea>
                            @error('meta_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3 d-flex justify-content-center">
                <button class="btn btn-admin-primary" type="submit">
                    <i class="bi bi-check-lg me-1"></i> Update Product
                </button>
            </div>
        </form>
    </div>
@endsection

@push('page_css')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/summernote/summernote-bs5.min.css') }}">
    <style>
        .image-preview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .image-preview-item {
            position: relative;
            aspect-ratio: 1;
            border-radius: 8px;
            overflow: hidden;
            border: 2px solid #e2e8f0;
        }

        .image-preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .remove-image {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(239, 68, 68, 0.9);
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            z-index: 10;
        }

        .remove-image:hover {
            background: #dc2626;
            transform: scale(1.1);
        }

        .existing-image-item {
            position: relative;
            width: 100px;
            height: 100px;
            border-radius: 8px;
            overflow: hidden;
        }

        .existing-image-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

            /* discount calculation */
            $('#discount, #price').on('keyup', function() {
                var discount = $('#discount').val();
                var price = $('#price').val();
                if (price && discount) {
                    var discountPrice = price - (price * discount / 100);
                    $('#discount_price').val(discountPrice.toFixed(2));
                }
            });

            /* summernote initialization */
            $('.summernote').summernote({
                height: 300,
                focus: true,
            });

            /* get subcategory by category id */
            $("#category_id").on('change', function() {
                let categoryId = $(this).val();
                if(categoryId) {
                    $.ajax({
                        url: '{{ route('getSubCategories') }}',
                        type: 'GET',
                        data: { category_id: categoryId },
                        success: function(response) {
                            $('#sub_category_id').html(response);
                        }
                    });
                } else {
                    $('#sub_category_id').html('<option value="">Select Sub-Category</option>');
                }
            });

            // Image Preview logic
            $('#productUploadZone').on('click', function() {
                $('#productImageUpload').click();
            });

            $('#productImageUpload').on('change', function(e) {
                const files = e.target.files;
                const previewGrid = $('#imagePreviewGrid');
                previewGrid.empty(); // Clear previews to match current selection

                Array.from(files).forEach(file => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            const html = `
                                <div class="image-preview-item">
                                    <img src="${event.target.result}" alt="Preview">
                                    <button type="button" class="remove-image remove-new-preview">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </div>
                            `;
                            previewGrid.append(html);
                        }
                        reader.readAsDataURL(file);
                    }
                });
            });

            // Remove new preview (note: this doesn't remove from the input file list, but clears the UI)
            $(document).on('click', '.remove-new-preview', function() {
                $(this).closest('.image-preview-item').remove();
            });

            // Delete existing image via AJAX
            $(document).on('click', '.delete-existing-image', function() {
                const imageId = $(this).data('id');
                const container = $(`#image-container-${imageId}`);

                if (confirm('Are you sure you want to delete this image?')) {
                    $.ajax({
                        url: `{{ route('admin.product-image.destroy') }}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: imageId
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                container.fadeOut(300, function() {
                                    $(this).remove();
                                });
                            }
                        },
                        error: function() {
                            alert('Failed to delete image. Please try again.');
                        }
                    });
                }
            });
        });
    </script>
@endpush
