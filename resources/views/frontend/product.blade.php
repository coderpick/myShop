@extends('layouts.frontend.HomeLayout')
@section('pageTitle', 'Shop')
@section('content')

    <!-- Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ uri('/') }}"><i class="bi bi-house-door"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('shop') }}">Shop</a></li>
                    <li class="breadcrumb-item"><a href="#">{{ $product->category->name }}</a></li>
                    <li class="breadcrumb-item active">{{ $product->name }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- ============ PRODUCT DETAILS ============ -->
    <section class="section-padding">
        <div class="container">
            <div class="row g-5">
                <!-- Product Gallery -->
                <div class="col-lg-6">
                    <div class="product-gallery">
                        <div class="main-image" id="mainImage">
                            <img src="{{ asset($product->images->first()->image_path) }}" alt="{{ $product->name }}"
                                id="mainProductImage">
                        </div>
                        <div class="thumbnail-list">
                            @forelse ($product->images as $key => $singleImage)
                                <div class="thumbnail {{ $loop->first ? 'active' : '' }}"
                                    onclick="changeImage({{ $key + 1 }}, '{{ asset($singleImage->image_path) }}')">
                                    <img src="{{ asset($singleImage->image_path) }}" alt="Front View">
                                </div>
                            @empty
                                <p>No images found</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-lg-6">
                    <div class="product-detail-info">
                        <span class="badge bg-primary mb-2">{{ $product->category->name ?? '' }}</span>
                        <h1 class="product-title">{{ $product->name }}</h1>

                        <div class="product-meta">
                            <div class="rating-display">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-half"></i>
                                </div>
                                <span class="rating-text">4.5 (234 Reviews)</span>
                            </div>
                            <span class="text-muted">|</span>
                            <div class="stock-status in-stock">
                                <i class="bi bi-check-circle-fill"></i> In Stock
                            </div>
                            <span class="text-muted">|</span>
                            <span class="text-muted small">SKU: APL-IP15P-256</span>
                        </div>

                        <!-- Price -->
                        <div class="price-block">
                            @if ($product->discount > 0 && $product->discount_price > 0)
                                <span class="current">${{ $product->discount_price }}</span>
                                <span class="original">${{ $product->price }}</span>
                                <div class="savings">
                                    <i class="bi bi-tag-fill me-1"></i> You Save:
                                    ${{ $product->price - $product->discount_price }} ({{ $product->discount }}% OFF)
                                </div>
                            @else
                                <span class="current">${{ $product->price }}</span>
                            @endif
                        </div>

                        <!-- Short Description -->
                        <p class="text-muted mb-3">
                            {!! $product->short_description !!}
                        </p>
                        <!-- Color Selection -->
                        {{--   <div class="mb-3">
                            <span class="fw-bold mb-2 d-block">Color: <span class="fw-normal text-muted">Natural
                                    Titanium</span></span>
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm rounded-circle border-2 border-primary"
                                    style="width:36px;height:36px;background:#c4b5a0;" title="Natural Titanium"></button>
                                <button class="btn btn-sm rounded-circle border"
                                    style="width:36px;height:36px;background:#3b3b3d;" title="Black Titanium"></button>
                                <button class="btn btn-sm rounded-circle border"
                                    style="width:36px;height:36px;background:#f5f5f0;" title="White Titanium"></button>
                                <button class="btn btn-sm rounded-circle border"
                                    style="width:36px;height:36px;background:#394150;" title="Blue Titanium"></button>
                            </div>
                        </div>
 --}}
                        <!-- Storage Selection -->
                        {{--  <div class="mb-3">
                            <span class="fw-bold mb-2 d-block">Storage:</span>
                            <div class="d-flex gap-2 flex-wrap">
                                <button class="btn btn-outline-primary btn-sm px-3">128GB</button>
                                <button class="btn btn-primary btn-sm px-3">256GB</button>
                                <button class="btn btn-outline-primary btn-sm px-3">512GB</button>
                                <button class="btn btn-outline-primary btn-sm px-3">1TB</button>
                            </div>
                        </div> --}}

                        <!-- Quantity -->
                        <div class="mb-4">
                            <span class="fw-bold mb-2 d-block">Quantity:</span>
                            <div class="quantity-selector">
                                <button onclick="updateQty(-1)">−</button>
                                <input type="number" value="1" min="1" max="10" id="productQty">
                                <button onclick="updateQty(1)">+</button>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-3 mb-4 flex-wrap">
                            <button class="btn btn-primary-custom btn-lg flex-grow-1" onclick="addToCart({{ $product->id }})">
                                <i class="bi bi-cart-plus me-2"></i> Add to Cart
                            </button>
                            <button class="btn btn-secondary-custom btn-lg flex-grow-1">
                                <i class="bi bi-lightning me-2"></i> Buy Now
                            </button>
                            <button class="btn btn-outline-custom" onclick="toggleWishlist(this)">
                                <i class="bi bi-heart"></i>
                            </button>
                        </div>

                        <!-- Trust Badges -->
                        <div class="row g-2 text-center">
                            <div class="col-4">
                                <div class="p-2 bg-light rounded">
                                    <i class="bi bi-truck text-primary d-block mb-1"></i>
                                    <span class="small">Free Delivery</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 bg-light rounded">
                                    <i class="bi bi-arrow-repeat text-primary d-block mb-1"></i>
                                    <span class="small">30-Day Returns</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 bg-light rounded">
                                    <i class="bi bi-shield-check text-primary d-block mb-1"></i>
                                    <span class="small">1 Year Warranty</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== PRODUCT TABS ===== -->
            <div class="product-tabs mt-5">
                <ul class="nav nav-tabs" id="productTabs" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab"
                            data-bs-target="#description">Description</button>
                    </li>
                    {{-- <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab"
                            data-bs-target="#specifications">Specifications</button>
                    </li> --}}
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#reviews">Reviews (234)</button>
                    </li>
                </ul>
                <div class="tab-content pt-4" id="productTabContent">
                    <!-- Description Tab -->
                    <div class="tab-pane fade show active" id="description">
                        <div class="row">
                            <div class="col-lg-8">
                                {!! $product->description !!}
                            </div>
                        </div>
                    </div>
                    <!-- Specifications Tab -->
                    {{--   <div class="tab-pane fade" id="specifications">
                        <div class="row">
                            <div class="col-lg-8">
                                <table class="table specs-table">
                                    <tbody>
                                        <tr>
                                            <th>Display</th>
                                            <td>6.1" Super Retina XDR, 2556x1179, 120Hz ProMotion</td>
                                        </tr>
                                        <tr>
                                            <th>Processor</th>
                                            <td>A17 Pro chip, 6-core CPU, 6-core GPU</td>
                                        </tr>
                                        <tr>
                                            <th>RAM</th>
                                            <td>8GB</td>
                                        </tr>
                                        <tr>
                                            <th>Storage</th>
                                            <td>256GB</td>
                                        </tr>
                                        <tr>
                                            <th>Rear Camera</th>
                                            <td>48MP Main + 12MP Ultra Wide + 12MP Telephoto (5x)</td>
                                        </tr>
                                        <tr>
                                            <th>Front Camera</th>
                                            <td>12MP TrueDepth</td>
                                        </tr>
                                        <tr>
                                            <th>Battery</th>
                                            <td>3,274 mAh, Up to 23 hours video playback</td>
                                        </tr>
                                        <tr>
                                            <th>OS</th>
                                            <td>iOS 17</td>
                                        </tr>
                                        <tr>
                                            <th>Connectivity</th>
                                            <td>5G, Wi-Fi 6E, Bluetooth 5.3, NFC, USB-C 3.0</td>
                                        </tr>
                                        <tr>
                                            <th>Water Resistance</th>
                                            <td>IP68 (6 meters, 30 minutes)</td>
                                        </tr>
                                        <tr>
                                            <th>Weight</th>
                                            <td>187 grams</td>
                                        </tr>
                                        <tr>
                                            <th>Dimensions</th>
                                            <td>146.6 x 70.6 x 8.25 mm</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> --}}
                    <!-- Reviews Tab -->
                    <div class="tab-pane fade" id="reviews">
                        <div class="row">
                            <div class="col-lg-8">
                                <!-- Review Summary -->
                                <div class="d-flex align-items-center gap-4 mb-4 p-3 bg-light rounded">
                                    <div class="text-center">
                                        <div class="fs-1 fw-bold text-primary">4.5</div>
                                        <div class="stars text-warning">
                                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-half"></i>
                                        </div>
                                        <div class="small text-muted">234 Reviews</div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <span class="small">5★</span>
                                            <div class="progress flex-grow-1" style="height: 8px;">
                                                <div class="progress-bar bg-warning" style="width: 65%;"></div>
                                            </div>
                                            <span class="small text-muted">152</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <span class="small">4★</span>
                                            <div class="progress flex-grow-1" style="height: 8px;">
                                                <div class="progress-bar bg-warning" style="width: 22%;"></div>
                                            </div>
                                            <span class="small text-muted">51</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <span class="small">3★</span>
                                            <div class="progress flex-grow-1" style="height: 8px;">
                                                <div class="progress-bar bg-warning" style="width: 8%;"></div>
                                            </div>
                                            <span class="small text-muted">19</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <span class="small">2★</span>
                                            <div class="progress flex-grow-1" style="height: 8px;">
                                                <div class="progress-bar bg-warning" style="width: 3%;"></div>
                                            </div>
                                            <span class="small text-muted">7</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="small">1★</span>
                                            <div class="progress flex-grow-1" style="height: 8px;">
                                                <div class="progress-bar bg-warning" style="width: 2%;"></div>
                                            </div>
                                            <span class="small text-muted">5</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Individual Reviews -->
                                <div class="border-bottom pb-3 mb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <div>
                                            <strong>Michael Chen</strong>
                                            <span class="badge bg-success ms-2">Verified Purchase</span>
                                        </div>
                                        <span class="small text-muted">2 days ago</span>
                                    </div>
                                    <div class="stars text-warning mb-2" style="font-size: 0.8rem;">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i>
                                    </div>
                                    <h6 class="fw-bold">Best iPhone yet!</h6>
                                    <p class="text-muted small">The titanium design feels premium and the camera is
                                        incredible. Battery life is noticeably better. The action button is a great
                                        addition.</p>
                                </div>

                                <div class="border-bottom pb-3 mb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <div>
                                            <strong>Emily Rodriguez</strong>
                                            <span class="badge bg-success ms-2">Verified Purchase</span>
                                        </div>
                                        <span class="small text-muted">1 week ago</span>
                                    </div>
                                    <div class="stars text-warning mb-2" style="font-size: 0.8rem;">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star"></i>
                                    </div>
                                    <h6 class="fw-bold">Great upgrade from iPhone 13</h6>
                                    <p class="text-muted small">Loving the new camera system. The 5x optical zoom is
                                        amazing. USB-C is a welcome change. Only wish the battery lasted a bit longer.
                                    </p>
                                </div>

                                <div class="pb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <div>
                                            <strong>James Wilson</strong>
                                            <span class="badge bg-success ms-2">Verified Purchase</span>
                                        </div>
                                        <span class="small text-muted">2 weeks ago</span>
                                    </div>
                                    <div class="stars text-warning mb-2" style="font-size: 0.8rem;">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-half"></i>
                                    </div>
                                    <h6 class="fw-bold">Solid phone, premium feel</h6>
                                    <p class="text-muted small">The titanium frame makes a huge difference in weight and
                                        feel. Performance is blazing fast. ProMotion display is butter smooth.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== RELATED PRODUCTS ===== -->
            <div class="mt-5">
                <h3 class="section-title mb-4">Related Products</h3>
                <div class="row g-4">
                    @forelse ($relatedProducts as $relatedProduct)
                        <div class="col-6 col-md-3">
                            <div class="product-card">
                                @if ($relatedProduct->is_new_arrival)
                                    <div class="product-badge">
                                        <span class="badge-new">NEW</span>
                                    </div>
                                @endif
                                @if ($relatedProduct->discount > 0 && $relatedProduct->discount_price != null)
                                    <div class="product-badge">
                                        <span class="badge-sale">-{{ $relatedProduct->discount }}%</span>
                                    </div>
                                @endif
                                <div class="product-actions"><button class="action-btn" onclick="toggleWishlist(this)"><i
                                            class="bi bi-heart"></i></button></div>
                                <a href="{{ route('product.show', $relatedProduct->slug) }}">
                                    <div class="product-image"><img
                                            src="{{ asset($relatedProduct->images->first()->image_path) }}"
                                            alt="{{ $relatedProduct->name }}"></div>
                                </a>
                                <div class="product-info">
                                    <span class="product-category">{{ $relatedProduct->category->name ?? '' }}</span>
                                    <h6><a
                                            href="{{ route('product.show', $relatedProduct->slug) }}">{{ $relatedProduct->name }}</a>
                                    </h6>
                                    <div class="product-rating">
                                        <div class="stars"><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div><span
                                            class="rating-count">(789)</span>
                                    </div>

                                    <div class="product-price">
                                        @if ($relatedProduct->discount > 0 && $relatedProduct->discount_price > 0)
                                            <span class="current-price">{{ $relatedProduct->discount_price }}</span>
                                            <span class="original-price">{{ $relatedProduct->price }}</span>
                                        @else
                                            <span class="current-price">{{ $relatedProduct->price }}</span>
                                        @endif
                                    </div>


                                    <button class="btn-add-cart" onclick="addToCart({{ $relatedProduct->id }})"><i
                                            class="bi bi-cart-plus"></i> Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    @empty
                        No related products found!
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
