@extends('layouts.backend.master')
@section('content')
    <div class="admin-content">
        <div class="page-header">
            <div>
                <h1>Product Details</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Products</a></li>
                        <li class="breadcrumb-item active">Product Details</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-primary">
                    <i class="bi bi-pencil"></i> Edit Product
                </a>
                <a href="{{ route('admin.product.index') }}" class="btn btn-warning">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </div>
        </div>

        <div class="row g-4">
            <!-- Product Overview -->
            <div class="col-lg-8">
                <div class="form-card mb-4">
                    <div class="form-title"><i class="bi bi-info-circle"></i> Basic Information</div>
                    <div class="row mb-3">
                        <div class="col-sm-3 fw-bold">Name:</div>
                        <div class="col-sm-9">{{ $product->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 fw-bold">Slug:</div>
                        <div class="col-sm-9 text-muted">{{ $product->slug }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 fw-bold">Short Description:</div>
                        <div class="col-sm-9">{{ $product->short_description }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 fw-bold">Category:</div>
                        <div class="col-sm-9">{{ $product->category->name ?? 'N/A' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 fw-bold">Sub-Category:</div>
                        <div class="col-sm-9">{{ $product->subCategory->name ?? 'N/A' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 fw-bold">Brand:</div>
                        <div class="col-sm-9">{{ $product->brand->name ?? 'N/A' }}</div>
                    </div>
                </div>

                <div class="form-card mb-4">
                    <div class="form-title"><i class="bi bi-card-text"></i> Full Description</div>
                    <div class="product-description">
                        {!! $product->description !!}
                    </div>
                </div>

                <div class="form-card mb-4">
                    <div class="form-title"><i class="bi bi-images"></i> Product Images</div>
                    <div class="row g-2">
                        @forelse($product->images as $image)
                            <div class="col-md-3">
                                <a href="{{ asset($image->image_path) }}" target="_blank">
                                    <img src="{{ asset($image->image_path) }}" alt="Product Image" class="img-fluid rounded border">
                                </a>
                            </div>
                        @empty
                            <div class="col-12 text-muted">No images found for this product.</div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Side Info -->
            <div class="col-lg-4">
                <div class="form-card mb-4">
                    <div class="form-title"><i class="bi bi-currency-dollar"></i> Pricing & Inventory</div>
                    <div class="mb-3">
                        <label class="d-block text-muted small">Price</label>
                        @if ($product->discount)
                            <span class="fs-4 fw-bold text-primary">${{ number_format($product->discount_price, 2) }}</span>
                            <span class="text-muted text-decoration-line-through ms-2">${{ number_format($product->price, 2) }}</span>
                            <span class="badge bg-danger ms-2">{{ $product->discount }}% OFF</span>
                        @else
                            <span class="fs-4 fw-bold text-primary">${{ number_format($product->price, 2) }}</span>
                        @endif
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-6 text-muted small">SKU:</div>
                        <div class="col-6 text-end">{{ $product->sku }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-muted small">Stock Status:</div>
                        <div class="col-6 text-end">
                            @if($product->stock > $product->low_stock_alert)
                                <span class="badge bg-success">In Stock ({{ $product->stock }})</span>
                            @elseif($product->stock > 0)
                                <span class="badge bg-warning text-dark">Low Stock ({{ $product->stock }})</span>
                            @else
                                <span class="badge bg-danger">Out of Stock</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-muted small">Status:</div>
                        <div class="col-6 text-end">
                            <span class="badge {{ $product->status === 'published' ? 'bg-primary' : 'bg-secondary' }}">
                                {{ ucfirst($product->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-card mb-4">
                    <div class="form-title"><i class="bi bi-lightning"></i> Product Tags</div>
                    <div class="d-flex flex-wrap gap-2">
                        @if($product->is_featured) <span class="badge bg-info text-dark">Featured</span> @endif
                        @if($product->is_new_arrival) <span class="badge bg-success">New Arrival</span> @endif
                        @if($product->is_bestseller) <span class="badge bg-warning text-dark">Bestseller</span> @endif
                        @if($product->is_popular) <span class="badge bg-primary">Popular</span> @endif
                        @if($product->is_trending) <span class="badge bg-dark">Trending</span> @endif
                    </div>
                </div>

                <div class="form-card">
                    <div class="form-title"><i class="bi bi-search"></i> SEO Information</div>
                    <div class="mb-2">
                        <label class="d-block text-muted small">Meta Title</label>
                        <p class="small mb-1">{{ $product->meta_title ?? 'N/A' }}</p>
                    </div>
                    <div class="mb-2">
                        <label class="d-block text-muted small">Meta Keywords</label>
                        <p class="small mb-1">{{ $product->meta_keywords ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="d-block text-muted small">Meta Description</label>
                        <p class="small mb-0">{{ $product->meta_description ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
