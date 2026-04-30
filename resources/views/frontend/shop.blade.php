@extends('layouts.frontend.HomeLayout')
@section('pageTitle', 'Shop')
@section('content')
    <!-- ============ BREADCRUMB ============ -->
    <section class="breadcrumb-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ uri('/') }}"><i class="bi bi-house-door"></i> Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shop</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- ============ SHOP CONTENT ============ -->
    <section class="section-padding">
        <div class="container">
            <div class="row g-4">

                <!-- ===== SIDEBAR FILTERS ===== -->
                <div class="col-lg-3">
                    <!-- Mobile Filter Toggle -->
                    <button class="btn btn-primary-custom w-100 d-lg-none mb-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#filterCollapse">
                        <i class="bi bi-funnel me-2"></i> Filters
                    </button>

                    <div class="collapse d-lg-block" id="filterCollapse">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body filter-sidebar">
                                <!-- Category Filter -->
                                <div class="filter-group">
                                    <h6 class="filter-title">Category</h6>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="catSmartphones" checked>
                                        <label class="form-check-label" for="catSmartphones">Smartphones <span
                                                class="text-muted">(120)</span></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="catLaptops">
                                        <label class="form-check-label" for="catLaptops">Laptops <span
                                                class="text-muted">(85)</span></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="catAudio">
                                        <label class="form-check-label" for="catAudio">Audio <span
                                                class="text-muted">(65)</span></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="catWearables">
                                        <label class="form-check-label" for="catWearables">Wearables <span
                                                class="text-muted">(40)</span></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="catGaming">
                                        <label class="form-check-label" for="catGaming">Gaming <span
                                                class="text-muted">(95)</span></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="catCameras">
                                        <label class="form-check-label" for="catCameras">Cameras <span
                                                class="text-muted">(30)</span></label>
                                    </div>
                                </div>

                                <!-- Price Range -->
                                <div class="filter-group">
                                    <h6 class="filter-title">Price Range</h6>
                                    <div class="price-range-slider">
                                        <input type="range" class="form-range" id="priceRange" min="0"
                                            max="3000" value="1500">
                                        <div class="price-display">
                                            <span>$0</span>
                                            <span id="priceValue">$1,500</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Brand Filter -->
                                <div class="filter-group">
                                    <h6 class="filter-title">Brand</h6>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="brandApple">
                                        <label class="form-check-label" for="brandApple">Apple <span
                                                class="text-muted">(45)</span></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="brandSamsung">
                                        <label class="form-check-label" for="brandSamsung">Samsung <span
                                                class="text-muted">(38)</span></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="brandSony">
                                        <label class="form-check-label" for="brandSony">Sony <span
                                                class="text-muted">(22)</span></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="brandDell">
                                        <label class="form-check-label" for="brandDell">Dell <span
                                                class="text-muted">(18)</span></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="brandLG">
                                        <label class="form-check-label" for="brandLG">LG <span
                                                class="text-muted">(15)</span></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="brandBose">
                                        <label class="form-check-label" for="brandBose">Bose <span
                                                class="text-muted">(12)</span></label>
                                    </div>
                                </div>

                                <!-- Rating Filter -->
                                <div class="filter-group">
                                    <h6 class="filter-title">Rating</h6>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rating" id="rating5">
                                        <label class="form-check-label" for="rating5">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <span class="text-muted small"> & Up</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rating" id="rating4">
                                        <label class="form-check-label" for="rating4">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star text-warning"></i>
                                            <span class="text-muted small"> & Up</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="rating" id="rating3">
                                        <label class="form-check-label" for="rating3">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star text-warning"></i>
                                            <i class="bi bi-star text-warning"></i>
                                            <span class="text-muted small"> & Up</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Clear Filters -->
                                <button class="btn btn-outline-custom w-100 btn-sm">
                                    <i class="bi bi-x-circle me-1"></i> Clear All Filters
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===== PRODUCT LISTING ===== -->
                <div class="col-lg-9">
                    <!-- Sort Bar -->
                    <div class="sort-bar d-flex flex-wrap justify-content-between align-items-center">
                        <div>
                            <span class="text-muted">Showing <strong>1-12</strong> of <strong>256</strong>
                                products</span>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="d-flex align-items-center gap-2">
                                <label class="small text-muted text-nowrap">Sort by:</label>
                                <select class="form-select form-select-sm" style="width: auto;">
                                    <option>Featured</option>
                                    <option>Price: Low to High</option>
                                    <option>Price: High to Low</option>
                                    <option>Newest First</option>
                                    <option>Best Rating</option>
                                    <option>Best Selling</option>
                                </select>
                            </div>
                            <div class="view-toggle d-none d-md-flex">
                                <button class="btn btn-sm active"><i class="bi bi-grid-3x3-gap"></i></button>
                                <button class="btn btn-sm"><i class="bi bi-list-ul"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Product Grid -->
                    <div class="row g-4">
                        <!-- Product 1 -->
                        <div class="col-6 col-md-4">
                            <div class="product-card">
                                <div class="product-badge"><span class="badge-sale">-17%</span></div>
                                <div class="product-actions">
                                    <button class="action-btn" onclick="toggleWishlist(this)"><i
                                            class="bi bi-heart"></i></button>
                                    <button class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                            class="bi bi-eye"></i></button>
                                </div>
                                <a href="product.html">
                                    <div class="product-image">
                                        <img src="https://via.placeholder.com/200x200/f1f5f9/2563eb?text=iPhone+15"
                                            alt="iPhone 15">
                                    </div>
                                </a>
                                <div class="product-info">
                                    <span class="product-category">Smartphones</span>
                                    <h6><a href="product.html">Apple iPhone 15 Pro 256GB</a></h6>
                                    <div class="product-rating">
                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-half"></i>
                                        </div>
                                        <span class="rating-count">(234)</span>
                                    </div>
                                    <div class="product-price">
                                        <span class="current-price">$999</span>
                                        <span class="original-price">$1,199</span>
                                    </div>
                                    <button class="btn-add-cart" onclick="addToCart('iPhone 15 Pro')">
                                        <i class="bi bi-cart-plus"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Product 2 -->
                        <div class="col-6 col-md-4">
                            <div class="product-card">
                                <div class="product-badge"><span class="badge-new">NEW</span></div>
                                <div class="product-actions">
                                    <button class="action-btn" onclick="toggleWishlist(this)"><i
                                            class="bi bi-heart"></i></button>
                                    <button class="action-btn"><i class="bi bi-eye"></i></button>
                                </div>
                                <a href="product.html">
                                    <div class="product-image">
                                        <img src="https://via.placeholder.com/200x200/f1f5f9/1a1a2e?text=MacBook"
                                            alt="MacBook">
                                    </div>
                                </a>
                                <div class="product-info">
                                    <span class="product-category">Laptops</span>
                                    <h6><a href="product.html">MacBook Air M2 15" 512GB</a></h6>
                                    <div class="product-rating">
                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i>
                                        </div>
                                        <span class="rating-count">(189)</span>
                                    </div>
                                    <div class="product-price">
                                        <span class="current-price">$1,299</span>
                                        <span class="original-price">$1,499</span>
                                    </div>
                                    <button class="btn-add-cart" onclick="addToCart('MacBook Air')">
                                        <i class="bi bi-cart-plus"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Product 3 -->
                        <div class="col-6 col-md-4">
                            <div class="product-card">
                                <div class="product-badge"><span class="badge-sale">-25%</span></div>
                                <div class="product-actions">
                                    <button class="action-btn" onclick="toggleWishlist(this)"><i
                                            class="bi bi-heart"></i></button>
                                    <button class="action-btn"><i class="bi bi-eye"></i></button>
                                </div>
                                <a href="product.html">
                                    <div class="product-image">
                                        <img src="https://via.placeholder.com/200x200/f1f5f9/134e4a?text=Sony+XM5"
                                            alt="Sony XM5">
                                    </div>
                                </a>
                                <div class="product-info">
                                    <span class="product-category">Audio</span>
                                    <h6><a href="product.html">Sony WH-1000XM5 Wireless</a></h6>
                                    <div class="product-rating">
                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star"></i>
                                        </div>
                                        <span class="rating-count">(412)</span>
                                    </div>
                                    <div class="product-price">
                                        <span class="current-price">$299</span>
                                        <span class="original-price">$399</span>
                                    </div>
                                    <button class="btn-add-cart" onclick="addToCart('Sony XM5')">
                                        <i class="bi bi-cart-plus"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Product 4 -->
                        <div class="col-6 col-md-4">
                            <div class="product-card">
                                <div class="product-actions">
                                    <button class="action-btn" onclick="toggleWishlist(this)"><i
                                            class="bi bi-heart"></i></button>
                                    <button class="action-btn"><i class="bi bi-eye"></i></button>
                                </div>
                                <a href="product.html">
                                    <div class="product-image">
                                        <img src="https://via.placeholder.com/200x200/f1f5f9/d97706?text=Galaxy+S24"
                                            alt="Galaxy S24">
                                    </div>
                                </a>
                                <div class="product-info">
                                    <span class="product-category">Smartphones</span>
                                    <h6><a href="product.html">Samsung Galaxy S24 Ultra 512GB</a></h6>
                                    <div class="product-rating">
                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-half"></i>
                                        </div>
                                        <span class="rating-count">(156)</span>
                                    </div>
                                    <div class="product-price">
                                        <span class="current-price">$1,199</span>
                                        <span class="original-price">$1,299</span>
                                    </div>
                                    <button class="btn-add-cart" onclick="addToCart('Galaxy S24')">
                                        <i class="bi bi-cart-plus"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Product 5 -->
                        <div class="col-6 col-md-4">
                            <div class="product-card">
                                <div class="product-badge"><span class="badge-sale">-30%</span></div>
                                <div class="product-actions">
                                    <button class="action-btn" onclick="toggleWishlist(this)"><i
                                            class="bi bi-heart"></i></button>
                                    <button class="action-btn"><i class="bi bi-eye"></i></button>
                                </div>
                                <a href="product.html">
                                    <div class="product-image">
                                        <img src="https://via.placeholder.com/200x200/f1f5f9/ec4899?text=AirPods"
                                            alt="AirPods">
                                    </div>
                                </a>
                                <div class="product-info">
                                    <span class="product-category">Audio</span>
                                    <h6><a href="product.html">Apple AirPods Pro 2nd Gen</a></h6>
                                    <div class="product-rating">
                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i>
                                        </div>
                                        <span class="rating-count">(789)</span>
                                    </div>
                                    <div class="product-price">
                                        <span class="current-price">$179</span>
                                        <span class="original-price">$249</span>
                                        <span class="discount">Save $70</span>
                                    </div>
                                    <button class="btn-add-cart" onclick="addToCart('AirPods Pro')">
                                        <i class="bi bi-cart-plus"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Product 6 -->
                        <div class="col-6 col-md-4">
                            <div class="product-card">
                                <div class="product-actions">
                                    <button class="action-btn" onclick="toggleWishlist(this)"><i
                                            class="bi bi-heart"></i></button>
                                    <button class="action-btn"><i class="bi bi-eye"></i></button>
                                </div>
                                <a href="product.html">
                                    <div class="product-image">
                                        <img src="https://via.placeholder.com/200x200/f1f5f9/6366f1?text=PS5"
                                            alt="PS5">
                                    </div>
                                </a>
                                <div class="product-info">
                                    <span class="product-category">Gaming</span>
                                    <h6><a href="product.html">PlayStation 5 Console Bundle</a></h6>
                                    <div class="product-rating">
                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-half"></i>
                                        </div>
                                        <span class="rating-count">(534)</span>
                                    </div>
                                    <div class="product-price">
                                        <span class="current-price">$499</span>
                                    </div>
                                    <button class="btn-add-cart" onclick="addToCart('PS5')">
                                        <i class="bi bi-cart-plus"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Products 7-9 (additional) -->
                        <div class="col-6 col-md-4">
                            <div class="product-card">
                                <div class="product-badge"><span class="badge-new">NEW</span></div>
                                <div class="product-actions">
                                    <button class="action-btn" onclick="toggleWishlist(this)"><i
                                            class="bi bi-heart"></i></button>
                                    <button class="action-btn"><i class="bi bi-eye"></i></button>
                                </div>
                                <a href="product.html">
                                    <div class="product-image">
                                        <img src="https://via.placeholder.com/200x200/f1f5f9/0f766e?text=DJI+Mini"
                                            alt="DJI Drone">
                                    </div>
                                </a>
                                <div class="product-info">
                                    <span class="product-category">Gadgets</span>
                                    <h6><a href="product.html">DJI Mini 4 Pro Drone</a></h6>
                                    <div class="product-rating">
                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star"></i>
                                        </div>
                                        <span class="rating-count">(67)</span>
                                    </div>
                                    <div class="product-price">
                                        <span class="current-price">$759</span>
                                    </div>
                                    <button class="btn-add-cart" onclick="addToCart('DJI Mini 4')">
                                        <i class="bi bi-cart-plus"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-md-4">
                            <div class="product-card">
                                <div class="product-badge"><span class="badge-sale">-15%</span></div>
                                <div class="product-actions">
                                    <button class="action-btn" onclick="toggleWishlist(this)"><i
                                            class="bi bi-heart"></i></button>
                                    <button class="action-btn"><i class="bi bi-eye"></i></button>
                                </div>
                                <a href="product.html">
                                    <div class="product-image">
                                        <img src="https://via.placeholder.com/200x200/f1f5f9/ef4444?text=Dell+XPS"
                                            alt="Dell XPS">
                                    </div>
                                </a>
                                <div class="product-info">
                                    <span class="product-category">Laptops</span>
                                    <h6><a href="product.html">Dell XPS 15 Intel i7 16GB</a></h6>
                                    <div class="product-rating">
                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star"></i>
                                        </div>
                                        <span class="rating-count">(112)</span>
                                    </div>
                                    <div class="product-price">
                                        <span class="current-price">$1,299</span>
                                        <span class="original-price">$1,499</span>
                                    </div>
                                    <button class="btn-add-cart" onclick="addToCart('Dell XPS 15')">
                                        <i class="bi bi-cart-plus"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-md-4">
                            <div class="product-card">
                                <div class="product-actions">
                                    <button class="action-btn" onclick="toggleWishlist(this)"><i
                                            class="bi bi-heart"></i></button>
                                    <button class="action-btn"><i class="bi bi-eye"></i></button>
                                </div>
                                <a href="product.html">
                                    <div class="product-image">
                                        <img src="https://via.placeholder.com/200x200/f1f5f9/10b981?text=Watch+Ultra"
                                            alt="Apple Watch Ultra">
                                    </div>
                                </a>
                                <div class="product-info">
                                    <span class="product-category">Wearables</span>
                                    <h6><a href="product.html">Apple Watch Ultra 2 GPS</a></h6>
                                    <div class="product-rating">
                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i>
                                        </div>
                                        <span class="rating-count">(203)</span>
                                    </div>
                                    <div class="product-price">
                                        <span class="current-price">$799</span>
                                    </div>
                                    <button class="btn-add-cart" onclick="addToCart('Watch Ultra 2')">
                                        <i class="bi bi-cart-plus"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <nav class="mt-5">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">12</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection
