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
                                <img src="" alt="Product" id="qv-image"
                                    class="img-fluid">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <span class="badge bg-primary mb-2" id="qv-category"></span>
                            <h4 class="fw-bold" id="qv-name"></h4>
                            <div class="product-rating mb-2">
                                <div class="stars">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-half text-warning"></i>
                                </div>
                                <span class="rating-count">(0 Reviews)</span>
                            </div>
                            <div class="mb-3" id="qv-price-container">
                                <!-- Price will be dynamically injected here -->
                            </div>
                            <p class="text-muted mb-3" id="qv-description"></p>
                             <div class="d-flex gap-2">
                                 <button class="btn btn-primary-custom flex-grow-1" onclick="addToCartFromModal()">
                                     <i class="bi bi-cart-plus me-2"></i>Add to Cart
                                 </button>
                                 <button class="btn btn-outline-custom">
                                     <i class="bi bi-heart"></i>
                                 </button>
                             </div>
                            <a href="#" class="btn btn-link text-primary mt-2 p-0" id="qv-link">View Full Details →</a>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/cart/count')
                .then(res => res.json())
                .then(data => {
                    const el = document.getElementById('cartCount');
                    if (el) el.textContent = data.count;
                });
        });

        function addToCartFromModal() {
            const modalProductId = document.querySelector('.quick-view-modal')?.dataset.productId;
            if (modalProductId) {
                addToCart(parseInt(modalProductId));
            } else {
                showToastMsg('Please view the product page to add to cart.');
            }
        }

        function openQuickView(productId) {
            // Fetch product details via AJAX
            fetch(`{{ url('/product-quick-view') }}/${productId}`)
                .then(response => response.json())
                .then(data => {
                    // Populate modal fields
                    console.log(data);
                    
                    document.getElementById('qv-image').src = data.image;
                    document.getElementById('qv-category').textContent = data.category;
                    document.getElementById('qv-name').textContent = data.name;
                    
                    let priceHtml = '';
                    if (data.discount > 0 && data.discount_price > 0) {
                        priceHtml = `
                            <span class="fs-3 fw-bold text-primary">$${data.discount_price}</span>
                            <span class="text-decoration-line-through text-muted ms-2">$${data.price}</span>
                            <span class="badge bg-danger ms-2">-${data.discount}%</span>
                        `;
                    } else {
                        priceHtml = `<span class="fs-3 fw-bold text-primary">$${data.price}</span>`;
                    }
                    document.getElementById('qv-price-container').innerHTML = priceHtml;
                    
                    document.getElementById('qv-description').textContent = data.short_description;
                    document.getElementById('qv-link').href = data.product_url;
                    
                    // Set product ID on the modal for "Add to Cart" functionality
                    document.querySelector('.quick-view-modal').dataset.productId = data.id;

                    // Open the modal
                    const quickViewModal = new bootstrap.Modal(document.getElementById('quickViewModal'));
                    quickViewModal.show();
                })
                .catch(error => console.error('Error fetching product details:', error));
        }
    </script>
 
</body>

</html>
