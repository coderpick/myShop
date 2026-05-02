<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    @include('layouts.frontend.partials.head')
</head>

<body>

    <!-- ============ TOP BAR ============ -->
    @include('layouts.frontend.partials.topbar')

    <!-- ============ MAIN NAVBAR ============ -->
    @include('layouts.frontend.partials.navbar')
    <!-- ============ CATEGORY NAV ============ -->
    @include('layouts.frontend.partials.category_nav')

    <!-- ============ MOBILE MENU OFFCANVAS ============ -->
    @include('layouts.frontend.partials.mobile_nav')

    @yield('content')

    <!-- ============ FOOTER ============ -->
    @include('layouts.frontend.partials.footer')

    <!-- ============ QUICK VIEW MODAL ============ -->
    <div class="modal fade quick-view-modal" id="quickViewModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal"></button>
                    <div class="row g-4">
                        <div class="col-md-5">
                            <div class="text-center p-3 bg-light rounded">
                                <img src="https://via.placeholder.com/300x300/f1f5f9/2563eb?text=Product" alt="Product"
                                    class="img-fluid">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <span class="badge bg-primary mb-2">Smartphones</span>
                            <h4 class="fw-bold">Apple iPhone 15 Pro 256GB</h4>
                            <div class="product-rating mb-2">
                                <div class="stars">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-half text-warning"></i>
                                </div>
                                <span class="rating-count">(234 Reviews)</span>
                            </div>
                            <div class="mb-3">
                                <span class="fs-3 fw-bold text-primary">$999</span>
                                <span class="text-decoration-line-through text-muted ms-2">$1,199</span>
                                <span class="badge bg-danger ms-2">-17%</span>
                            </div>
                            <p class="text-muted mb-3">The most powerful iPhone ever. Features a stunning titanium
                                design, A17 Pro chip, and a revolutionary camera system.</p>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <span class="fw-bold">Color:</span>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm rounded-circle"
                                        style="width:30px;height:30px;background:#1e293b;border:2px solid #ccc;"></button>
                                    <button class="btn btn-sm rounded-circle"
                                        style="width:30px;height:30px;background:#e2e8f0;border:2px solid #ccc;"></button>
                                    <button class="btn btn-sm rounded-circle"
                                        style="width:30px;height:30px;background:#2563eb;border:2px solid #ccc;"></button>
                                </div>
                            </div>
                             <div class="d-flex gap-2">
                                 <button class="btn btn-primary-custom flex-grow-1" onclick="addToCartFromModal()">
                                     <i class="bi bi-cart-plus me-2"></i>Add to Cart
                                 </button>
                                 <button class="btn btn-outline-custom">
                                     <i class="bi bi-heart"></i>
                                 </button>
                             </div>
                            <a href="product.html" class="btn btn-link text-primary mt-2 p-0">View Full Details →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ============ BACK TO TOP ============ -->
    <button class="back-to-top" id="backToTop">
        <i class="bi bi-chevron-up"></i>
    </button>

    <!-- ============ TOAST NOTIFICATION ============ -->
    <div class="toast-container">
        <div class="toast align-items-center text-bg-success border-0" id="cartToast" role="alert">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-check-circle me-2"></i>
                    <span id="toastMessage">Product added to cart!</span>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                    data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

    @include('layouts.frontend.partials.scripts')
  
</body>

</html>
