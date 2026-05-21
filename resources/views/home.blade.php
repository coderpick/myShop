@extends('layouts.frontend.HomeLayout')
@section('pageTitle', 'Home')

@section('content')
    <!-- ============ HERO SLIDER ============ -->
    <section class="hero-slider">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <!-- Indicators -->
            <div class="carousel-indicators">
                @forelse ($sliders as $slider)
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $loop->index }}"
                        class="{{ $loop->first ? 'active' : '' }}"></button>
                @empty
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                @endforelse
            </div>

            <div class="carousel-inner">
                @forelse ($sliders as $slider)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <div class="container">
                            <a href="{{ $slider->link ?? '#' }}">
                                <img class="w-100" src="{{ asset($slider->image) }}" alt="{{ $slider->title }}">
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="carousel-item active">
                        <div class="container">
                            <a href="#">
                                <img class="w-100" src="{{ asset('assets/frontend/images/default-slider-bg.jpg') }}"
                                    alt="Placeholder">
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ============ FEATURES BAR ============ -->
    <section class="features-bar">
        <div class="container">
            <div class="row g-3">
                <div class="col-6 col-lg-3">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-truck"></i>
                        </div>
                        <div>
                            <h6>Free Shipping</h6>
                            <p>On orders over $50</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-arrow-repeat"></i>
                        </div>
                        <div>
                            <h6>Easy Returns</h6>
                            <p>30-day return policy</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div>
                            <h6>Secure Payment</h6>
                            <p>100% secure checkout</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-headset"></i>
                        </div>
                        <div>
                            <h6>24/7 Support</h6>
                            <p>Dedicated support</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ FEATURED CATEGORIES ============ -->
    <section class="section-padding">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="section-title">Shop by Category</h2>
                <p class="section-subtitle">Browse our wide range of electronic categories</p>
            </div>
            <div class="row g-4">
                @forelse ($categories as $category)
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="{{ route('shop', $category->slug) }}" class="text-decoration-none">
                            <div class="category-card">
                                <div class="category-icon">
                                    <i class="{{ $category->icon }}"></i>
                                </div>
                                <h6>{{ $category->name }}</h6>
                                <span class="product-count">{{ $category->products_count }} Products</span>
                            </div>
                        </a>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </section>

    <!-- ============ TRENDING PRODUCTS ============ -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="section-title mb-0">Trending Products</h2>
                    <p class="section-subtitle mb-0 mt-1">Most popular products this week</p>
                </div>
                <a href="shop.html" class="btn btn-outline-custom d-none d-md-inline-block">
                    View All <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>

            <div class="row g-4">
                @forelse ($trendingProducts as $trendingProduct)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="product-card">

                            @if ($trendingProduct->is_new_arrival)
                                <div class="product-badge">
                                    <span class="badge-new">NEW</span>
                                </div>
                            @endif
                            @if ($trendingProduct->discount > 0 && $trendingProduct->discount_price != null)
                                <div class="product-badge">
                                    <span class="badge-sale">-{{ $trendingProduct->discount }}%</span>
                                </div>
                            @endif
                            <div class="product-actions">
                                <button class="action-btn" title="Add to Wishlist" onclick="toggleWishlist(this)">
                                    <i class="bi bi-heart"></i>
                                </button>
                                <button class="action-btn" title="Quick View"
                                    onclick="openQuickView({{ $trendingProduct->id }})">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <a href="{{ route('product.show', $trendingProduct->slug) }}">
                                <div class="product-image">
                                    <img src="{{ asset($trendingProduct->images->first()->image_path) }}"
                                        alt="{{ $trendingProduct->name }}">
                                </div>
                            </a>
                            <div class="product-info">
                                <span class="product-category">{{ $trendingProduct->category->name }}</span>
                                <h6><a
                                        href="{{ route('product.show', $trendingProduct->slug) }}">{{ $trendingProduct->name }}</a>
                                </h6>
                                <div class="product-rating">
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                    </div>
                                    <span class="rating-count">(234)</span>
                                </div>
                                <div class="product-price">
                                    @if ($trendingProduct->discount > 0 && $trendingProduct->discount_price > 0)
                                        <span class="current-price">{{ $trendingProduct->discount_price }}</span>
                                        <span class="original-price">{{ $trendingProduct->price }}</span>
                                    @else
                                        <span class="current-price">{{ $trendingProduct->price }}</span>
                                    @endif
                                </div>
                                <button class="btn-add-cart" onclick="addToCart({{ $trendingProduct->id }})">
                                    <i class="bi bi-cart-plus"></i> Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
            <!-- Mobile View All -->
            <div class="text-center mt-4 d-md-none">
                <a href="{{ route('shop') }}" class="btn btn-outline-custom">View All Products</a>
            </div>
        </div>
    </section>
    @if ($flashDealProducts->count() > 0)
        <!-- ============ DEALS SECTION ============ -->
        <section class="deals-section section-padding">
            <div class="container">
                <div class="text-center mb-4">
                    <h2 class="section-title text-white">🔥 Flash Deals</h2>
                    <p class="text-light opacity-75">Hurry! These deals won't last long</p>
                </div>

                <div class="row g-4">
                    @forelse ($flashDealProducts as $flashDealProduct)
                        <div class="col-md-6 col-lg-4">
                            <div class="deal-card">
                                <div class="text-center mb-3">
                                    <img src="{{ asset($flashDealProduct->product->images->first()->image_path) }}"
                                        alt="{{ $flashDealProduct->product->name }}" style="max-height: 150px;">
                                </div>
                                <h5 class="text-white fw-bold">{{ $flashDealProduct->product->name }}</h5>
                                <p class="text-light opacity-75 small mb-2">
                                    {{ $flashDealProduct->product->short_description }}
                                </p>
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <div class="product-price">
                                        @if ($flashDealProduct->product->discount > 0 && $flashDealProduct->product->discount_price > 0)
                                            <span
                                                class="current-price text-white">{{ $flashDealProduct->product->discount_price }}</span>
                                            <span class="original-price">{{ $flashDealProduct->product->price }}</span>
                                            <span
                                                class="badge bg-danger">-{{ $flashDealProduct->product->discount }}%</span>
                                        @else
                                            <span
                                                class="current-price text-white">{{ $flashDealProduct->product->price }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="countdown-timer" data-target="{{ $flashDealProduct->end_date }}">
                                    {{-- date calculation --}}
                                    @php
                                        $endDate = \Carbon\Carbon::parse($flashDealProduct->end_date);
                                        $diff = $endDate->diff(\Carbon\Carbon::now());
                                    @endphp
                                    <div class="countdown-item">
                                        <span class="number" data-days>{{ $diff->days }}</span>
                                        <span class="label">Days</span>
                                    </div>
                                    <div class="countdown-item">
                                        <span class="number" data-hours>{{ $diff->hours }}</span>
                                        <span class="label">Hours</span>
                                    </div>
                                    <div class="countdown-item">
                                        <span class="number" data-minutes>{{ $diff->minutes }}</span>
                                        <span class="label">Mins</span>
                                    </div>
                                    <div class="countdown-item">
                                        <span class="number" data-seconds>{{ $diff->seconds }}</span>
                                        <span class="label">Secs</span>
                                    </div>
                                </div>
                                <!-- Stock Progress -->
                                <div class="mt-3">
                                    {{-- <div class="d-flex justify-content-between small text-light opacity-75 mb-1">
                                        <span>Sold: 87</span>
                                        <span>Available: 13</span>
                                    </div>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-warning" style="width: 87%;"></div>
                                    </div> --}}
                                </div>
                                <a href="javascript:void(0)" type="button" class="btn btn-secondary-custom w-100 mt-3"
                                    onclick="addToCart({{ $flashDealProduct->product->id }})">
                                    <i class="bi bi-lightning me-1"></i> Grab Deal
                                </a>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </section>
    @endif
    <!-- ============ BRAND CAROUSEL ============ -->
    <section class="brand-carousel-section">
        <div class="container">
            <div class="brand-slider">
                <div class="brand-track">
                    @forelse ($brands as $brand)
                        <a href="{{ route('shop.brand', $brand->slug) }}" class="brand-logo"
                            title="{{ $brand->name }}"><img src="{{ asset($brand->logo) }}"
                                alt="{{ $brand->name }}"></a>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- ============ TESTIMONIALS ============ -->
    <section class="section-padding">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="section-title">What Our Customers Say</h2>
                <p class="section-subtitle">Trusted by thousands of happy customers</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p>"Amazing experience! Got my MacBook delivered the next day. The packaging was perfect and the
                            price was the best I could find online."</p>
                        <div class="customer">
                            <img src="https://images.unsplash.com/photo-1599566150163-29194dcaad36?q=80&w=100&auto=format&fit=crop"
                                alt="Customer">
                            <div>
                                <h6>John Doe</h6>
                                <span>Verified Buyer</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p>"Customer service is top-notch! Had an issue with my order and they resolved it within hours.
                            Will definitely buy again from ElectroMart."</p>
                        <div class="customer">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=100&auto=format&fit=crop"
                                alt="Customer">
                            <div>
                                <h6>Sarah Miller</h6>
                                <span>Verified Buyer</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                        <p>"Great selection of electronics at competitive prices. The website is easy to navigate and
                            checkout was smooth. Highly recommended!"</p>
                        <div class="customer">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=100&auto=format&fit=crop"
                                alt="Customer">
                            <div>
                                <h6>Robert Wilson</h6>
                                <span>Verified Buyer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ NEWSLETTER ============ -->
    <section class="newsletter-section">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h3 class="fw-bold mb-2">Stay Updated!</h3>
                    <p class="opacity-90 mb-4">Subscribe to our newsletter and get exclusive deals, new arrivals, and
                        tech news delivered to your inbox.</p>
                    <div class="newsletter-form">
                        <input type="email" class="form-control" placeholder="Enter your email address">
                        <button class="btn" type="button">Subscribe</button>
                    </div>
                    <p class="small mt-3 opacity-75">
                        <i class="bi bi-lock me-1"></i> We respect your privacy. Unsubscribe at any time.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
