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
            <div class="d-flex gap-2">
                <button class="btn btn-admin-outline" type="button">
                    <i class="bi bi-eye me-1"></i> Preview
                </button>
                <button class="btn btn-admin-primary" onclick="showAlert('Product saved successfully!')">
                    <i class="bi bi-check-lg me-1"></i> Save Product
                </button>
            </div>
        </div>

        <!-- Alert placeholder -->
        <div class="alert alert-success alert-dismissible fade show d-none" role="alert" id="successAlert">
            <i class="bi bi-check-circle-fill me-2"></i>
            <span id="alertMessage">Success!</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>

        <form id="addProductForm">
            <div class="row g-4">
                <!-- Left Column - Main Info -->
                <div class="col-lg-8">
                    <!-- General Information -->
                    <div class="form-card mb-4">
                        <div class="form-title"><i class="bi bi-info-circle"></i> General Information</div>
                        <div class="mb-3">
                            <label class="form-label">Product Name *</label>
                            <input type="text" class="form-control" placeholder="Enter product name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" class="form-control" placeholder="auto-generated-slug">
                            <div class="form-text">Leave empty to auto-generate from product name.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description *</label>
                            <!-- Rich text editor placeholder - use a toolbar for demo -->
                            <div class="border rounded mb-1 p-2 bg-light d-flex gap-1 flex-wrap"
                                style="font-size: 0.8125rem;">
                                <button type="button" class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-type-bold"></i></button>
                                <button type="button" class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-type-italic"></i></button>
                                <button type="button" class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-type-underline"></i></button>
                                <span class="border-end mx-1"></span>
                                <button type="button" class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-list-ul"></i></button>
                                <button type="button" class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-list-ol"></i></button>
                                <span class="border-end mx-1"></span>
                                <button type="button" class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-link-45deg"></i></button>
                                <button type="button" class="btn btn-sm btn-outline-secondary"><i
                                        class="bi bi-image"></i></button>
                            </div>
                            <textarea class="form-control" rows="6" placeholder="Write product description..." required></textarea>
                        </div>
                    </div>

                    <!-- Product Images -->
                    <div class="form-card mb-4">
                        <div class="form-title"><i class="bi bi-images"></i> Product Images</div>
                        <div class="upload-zone" id="uploadZone">
                            <input type="file" id="imageUpload" multiple accept="image/*" hidden>
                            <div class="upload-icon"><i class="bi bi-cloud-arrow-up"></i></div>
                            <div class="upload-text">Click to upload or drag and drop</div>
                            <div class="upload-hint">PNG, JPG, WEBP up to 5MB each (Max 6 images)</div>
                        </div>
                        <div class="image-preview-grid" id="imagePreviewGrid">
                            <!-- Preview items populated by JS -->
                            <div class="image-preview-item">
                                <img src="https://via.placeholder.com/80x80/f1f5f9/4f46e5?text=1" alt="Preview">
                                <button type="button" class="remove-btn"><i class="bi bi-x"></i></button>
                            </div>
                            <div class="image-preview-item">
                                <img src="https://via.placeholder.com/80x80/f1f5f9/10b981?text=2" alt="Preview">
                                <button type="button" class="remove-btn"><i class="bi bi-x"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing -->
                    <div class="form-card mb-4">
                        <div class="form-title"><i class="bi bi-currency-dollar"></i> Pricing</div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Regular Price *</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" placeholder="0.00" step="0.01"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Discount Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" placeholder="0.00" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Cost Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" placeholder="0.00" step="0.01">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Inventory -->
                    <div class="form-card">
                        <div class="form-title"><i class="bi bi-archive"></i> Inventory</div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">SKU *</label>
                                <input type="text" class="form-control" placeholder="APL-IP15P-256" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Stock Quantity *</label>
                                <input type="number" class="form-control" placeholder="0" min="0" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Low Stock Alert</label>
                                <input type="number" class="form-control" placeholder="5" min="0">
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
                            <label class="form-label">Category *</label>
                            <select class="form-select" required>
                                <option value="">Select Category</option>
                                <option>Smartphones</option>
                                <option>Laptops</option>
                                <option>Audio</option>
                                <option>Wearables</option>
                                <option>Gaming</option>
                                <option>Cameras</option>
                                <option>Accessories</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sub-Category</label>
                            <select class="form-select">
                                <option value="">Select Sub-Category</option>
                                <option>Apple</option>
                                <option>Samsung</option>
                                <option>Google</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label">Brand</label>
                            <select class="form-select">
                                <option value="">Select Brand</option>
                                <option>Apple</option>
                                <option>Samsung</option>
                                <option>Sony</option>
                                <option>Dell</option>
                                <option>LG</option>
                                <option>Bose</option>
                            </select>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="form-card mb-4">
                        <div class="form-title"><i class="bi bi-toggle-on"></i> Status</div>
                        <div class="mb-3">
                            <label class="form-label">Product Status</label>
                            <select class="form-select">
                                <option>Active</option>
                                <option>Inactive</option>
                                <option>Draft</option>
                            </select>
                        </div>
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="featured" checked>
                            <label class="form-check-label small" for="featured">Featured Product</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="newArrival">
                            <label class="form-check-label small" for="newArrival">New Arrival</label>
                        </div>
                    </div>

                    <!-- Tags -->
                    <div class="form-card mb-4">
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
                    </div>

                    <!-- SEO -->
                    <div class="form-card">
                        <div class="form-title"><i class="bi bi-search"></i> SEO</div>
                        <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" class="form-control" placeholder="SEO title" maxlength="60">
                            <div class="form-text">0/60 characters</div>
                        </div>
                        <div>
                            <label class="form-label">Meta Description</label>
                            <textarea class="form-control" rows="3" placeholder="SEO description" maxlength="160"></textarea>
                            <div class="form-text">0/160 characters</div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
