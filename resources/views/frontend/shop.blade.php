@extends('layouts.frontend.HomeLayout')
@section('pageTitle', $filterItem ? $filterItem->name : 'Shop')

@section('content')
    <section class="breadcrumb-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house-door"></i> Home</a></li>
                    @if($filterType === 'category')
                        <li class="breadcrumb-item active" aria-current="page">{{ $filterItem->name }}</li>
                    @elseif($filterType === 'subcategory')
                        <li class="breadcrumb-item"><a href="{{ route('shop.category', $filterItem->category->slug) }}">{{ $filterItem->category->name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $filterItem->name }}</li>
                    @elseif($filterType === 'brand')
                        <li class="breadcrumb-item active" aria-current="page">{{ $filterItem->name }}</li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">Shop</li>
                    @endif
                </ol>
            </nav>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            <div class="row g-4">

                <div class="col-lg-3">
                    <button class="btn btn-primary-custom w-100 d-lg-none mb-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#filterCollapse">
                        <i class="bi bi-funnel me-2"></i> Filters
                    </button>

                    <div class="collapse d-lg-block" id="filterCollapse">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body filter-sidebar">
                                <div class="filter-group">
                                    <h6 class="filter-title">Category</h6>
                                    <a href="{{ route('shop') }}" class="d-block mb-2 text-decoration-none {{ !$filterType ? 'fw-bold text-primary' : 'text-dark' }}">
                                        All Categories
                                    </a>
                                    @forelse($categories as $cat)
                                        <div class="form-check mb-1">
                                            <a href="{{ route('shop.category', $cat->slug) }}" class="text-decoration-none {{ ($filterType === 'category' && $filterItem->id === $cat->id) ? 'fw-bold text-primary' : 'text-dark' }}">
                                                {{ $cat->name }} <span class="text-muted">({{ $cat->products_count }})</span>
                                            </a>
                                        </div>
                                    @empty
                                        <p class="text-muted small">No categories found</p>
                                    @endforelse
                                </div>

                                @if($filterType === 'category' && $filterItem->subCategories->count() > 0)
                                    <div class="filter-group">
                                        <h6 class="filter-title">Sub-Category</h6>
                                        @foreach($filterItem->subCategories as $subCat)
                                            <div class="form-check mb-1">
                                                <a href="{{ route('shop.subcategory', $subCat->slug) }}" class="text-decoration-none {{ ($filterType === 'subcategory' && $filterItem->id === $subCat->id) ? 'fw-bold text-primary' : 'text-dark' }}">
                                                    {{ $subCat->name }}
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="filter-group">
                                    <h6 class="filter-title">Brand</h6>
                                    @forelse($brands as $brand)
                                        <div class="form-check mb-1">
                                            <a href="{{ route('shop.brand', $brand->slug) }}" class="text-decoration-none {{ ($filterType === 'brand' && $filterItem->id === $brand->id) ? 'fw-bold text-primary' : 'text-dark' }}">
                                                {{ $brand->name }} <span class="text-muted">({{ $brand->products_count }})</span>
                                            </a>
                                        </div>
                                    @empty
                                        <p class="text-muted small">No brands found</p>
                                    @endforelse
                                </div>

                                <a href="{{ route('shop') }}" class="btn btn-outline-custom w-100 btn-sm mt-3">
                                    <i class="bi bi-x-circle me-1"></i> Clear All Filters
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="sort-bar d-flex flex-wrap justify-content-between align-items-center mb-4">
                        <div>
                            <span class="text-muted">Showing <strong>{{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }}</strong> of <strong>{{ $products->total() }}</strong> products</span>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="d-flex align-items-center gap-2">
                                <label class="small text-muted text-nowrap">Sort by:</label>
                                <select class="form-select form-select-sm" style="width: auto;" onchange="window.location.href='?sort='+this.value">
                                    <option value="">Default</option>
                                    <option value="price_low" {{ request('sort') === 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_high" {{ request('sort') === 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                    <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Newest First</option>
                                    <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Name A-Z</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4">
                        @forelse ($products as $product)
                            <div class="col-6 col-md-4">
                                <div class="product-card">
                                    @if ($product->is_new_arrival)
                                        <div class="product-badge"><span class="badge-new">NEW</span></div>
                                    @endif
                                    @if ($product->discount > 0 && $product->discount_price != null)
                                        <div class="product-badge"><span class="badge-sale">-{{ $product->discount }}%</span></div>
                                    @endif
                                    <div class="product-actions">
                                        <button class="action-btn" onclick="toggleWishlist(this)"><i class="bi bi-heart"></i></button>
                                        <button class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="bi bi-eye"></i></button>
                                    </div>
                                    <a href="{{ route('product.show', $product->slug) }}">
                                        <div class="product-image">
                                            @if ($product->images->count() > 0)
                                                <img src="{{ asset($product->images->first()->image_path) }}" alt="{{ $product->name }}">
                                            @else
                                                <img src="https://via.placeholder.com/200x200/f1f5f9/2563eb?text=Product" alt="{{ $product->name }}">
                                            @endif
                                        </div>
                                    </a>
                                    <div class="product-info">
                                        <span class="product-category">{{ $product->category->name ?? 'Electronics' }}</span>
                                        <h6><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h6>
                                        <div class="product-rating">
                                            <div class="stars">
                                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                                            </div>
                                            <span class="rating-count">(0)</span>
                                        </div>
                                        <div class="product-price">
                                            @if ($product->discount > 0 && $product->discount_price > 0)
                                                <span class="current-price">${{ number_format($product->discount_price, 2) }}</span>
                                                <span class="original-price">${{ number_format($product->price, 2) }}</span>
                                            @else
                                                <span class="current-price">${{ number_format($product->price, 2) }}</span>
                                            @endif
                                        </div>
                                        <button class="btn-add-cart" onclick="addToCart({{ $product->id }})">
                                            <i class="bi bi-cart-plus"></i> Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <i class="bi bi-box-seam fs-1 text-muted d-block mb-3"></i>
                                <h5 class="text-muted">No products found</h5>
                                <a href="{{ route('shop') }}" class="btn btn-primary-custom mt-3">Browse All Products</a>
                            </div>
                        @endforelse
                    </div>

                    @if($products->hasPages())
                        <nav class="mt-5">
                            <ul class="pagination justify-content-center">
                                @if($products->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link"><i class="bi bi-chevron-left"></i></span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}"><i class="bi bi-chevron-left"></i></a></li>
                                @endif

                                @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                    @if($page == $products->currentPage())
                                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach

                                @if($products->hasMorePages())
                                    <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}"><i class="bi bi-chevron-right"></i></a></li>
                                @else
                                    <li class="page-item disabled"><span class="page-link"><i class="bi bi-chevron-right"></i></span></li>
                                @endif
                            </ul>
                        </nav>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
