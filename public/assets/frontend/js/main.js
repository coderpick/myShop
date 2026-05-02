/* ============================================
   ElectroMart - Main JavaScript (jQuery)
   ============================================ */

$(document).ready(function() {
    initDarkMode();
    initBackToTop();
    initNavbarScroll();
    initPriceRange();
    initCountdown();
    initPaymentToggle();
    initCartFunctions();
    loadCartCount();
});

// ========== Dark Mode Toggle ==========
function initDarkMode() {
    var $toggle = $('#darkModeToggle');
    if (!$toggle.length) return;

    var savedTheme = localStorage.getItem('theme') || 'light';
    $('html').attr('data-theme', savedTheme);
    updateDarkModeIcon($toggle, savedTheme);

    $toggle.on('click', function() {
        var currentTheme = $('html').attr('data-theme');
        var newTheme = currentTheme === 'dark' ? 'light' : 'dark';

        $('html').attr('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        updateDarkModeIcon($toggle, newTheme);
    });
}

function updateDarkModeIcon($toggle, theme) {
    var $icon = $toggle.find('i');
    if (theme === 'dark') {
        $icon.attr('class', 'bi bi-sun-fill');
    } else {
        $icon.attr('class', 'bi bi-moon-fill');
    }
}

// ========== Back to Top Button ==========
function initBackToTop() {
    var $btn = $('#backToTop');
    if (!$btn.length) return;

    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 300) {
            $btn.addClass('show');
        } else {
            $btn.removeClass('show');
        }
    });

    $btn.on('click', function() {
        $('html, body').animate({ scrollTop: 0 }, 300);
    });
}

// ========== Navbar Scroll Effect ==========
function initNavbarScroll() {
    var $navbar = $('.navbar-main');
    if (!$navbar.length) return;

    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 50) {
            $navbar.addClass('scrolled');
        } else {
            $navbar.removeClass('scrolled');
        }
    });
}

// ========== Cart Functions ==========
function initCartFunctions() {
    $(document).on('click', '.quantity-selector button', function() {
        var $btn = $(this);
        var isIncrement = $.trim($btn.text()) === '+';
        var change = isIncrement ? 1 : -1;
        updateCartQty($btn, change);
    });

    $(document).on('click', '.btn-remove-item', function() {
        removeCartItem($(this));
    });

    $(document).on('click', '.btn-clear-cart', function(e) {
        e.preventDefault();
        clearCart();
    });
}

function addToCart(productId) {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: '/cart/add',
        type: 'POST',
        data: JSON.stringify({ product_id: productId, quantity: 1 }),
        contentType: 'application/json',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        success: function(data) {
            if (data.success) {
                updateCartBadge(data.count);
                showToastMsg(data.message);
            } else {
                showToastMsg(data.message || 'Failed to add to cart!');
            }
        },
        error: function() {
            showToastMsg('Failed to add to cart!');
        }
    });
}

function updateCartBadge(count) {
    var $el = $('#cartCount');
    if ($el.length) {
        $el.text(count).css('transform', 'scale(1.5)');
        setTimeout(function() {
            $el.css('transform', 'scale(1)');
        }, 200);
    }
}

function loadCartCount() {
    $.ajax({
        url: '/cart/count',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var $el = $('#cartCount');
            if ($el.length) $el.text(data.count);
        }
    });
}

function showToastMsg(message) {
    var $toastEl = $('#cartToast');
    var $toastMsg = $('#toastMessage');

    if ($toastEl.length && $toastMsg.length) {
        $toastMsg.text(message);
        var toast = new bootstrap.Toast($toastEl[0], { delay: 3000 });
        toast.show();
    }
}

function updateCartQty($btn, change) {
    var $container = $btn.closest('.quantity-selector');
    var $input = $container.find('input');

    var value = parseInt($input.val()) + change;
    if (value < 1) value = 1;
    if (value > 10) value = 10;
    $input.val(value);

    var $row = $btn.closest('tr, .cart-item');
    var productId = $row.data('product-id');

    if (!productId) return;

    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '/cart/update',
        type: 'POST',
        data: JSON.stringify({ product_id: parseInt(productId), quantity: value }),
        contentType: 'application/json',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        success: function(data) {
            if (data.success) {
                recalcCartRow($btn, data.subtotal);
                showToastMsg('Cart updated!');
            } else {
                showToastMsg(data.message || 'Failed to update cart!');
            }
        },
        error: function() {
            showToastMsg('Failed to update cart!');
        }
    });
}

function recalcCartRow($btn, newSubtotal) {
    var $row = $btn.closest('tr');
    if (!$row.length) return;

    var $subtotalEl = $row.find('.cart-subtotal');
    if ($subtotalEl.length) {
        $subtotalEl.text('$' + parseFloat(newSubtotal).toFixed(2));
    }

    updateCartTotals();
}

function updateCartTotals() {
    var subtotal = 0;
    $('.cart-subtotal').each(function() {
        var val = parseFloat($(this).text().replace('$', '')) || 0;
        subtotal += val;
    });

    var $totalEl = $('.cart-summary .summary-row.total span:last-child');
    if ($totalEl.length) {
        $totalEl.text('$' + subtotal.toFixed(2));
    }

    var $subtotalRow = $('.cart-summary .summary-row:not(.total) span:last-child');
    if ($subtotalRow.length) {
        $subtotalRow.text('$' + subtotal.toFixed(2));
    }
}

function removeCartItem($btn) {
    var $row = $btn.closest('tr');
    if (!$row.length) return;

    var productId = $row.data('product-id');
    if (!productId) return;

    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '/cart/remove',
        type: 'POST',
        data: JSON.stringify({ product_id: parseInt(productId) }),
        contentType: 'application/json',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        success: function(data) {
            if (data.success) {
                $row.css({ opacity: 0, transform: 'translateX(-20px)' });
                setTimeout(function() {
                    $row.remove();
                    updateCartBadge(data.count);
                    updateCartTotals();
                    checkCartEmpty();
                    showToastMsg(data.message);
                }, 300);
            } else {
                showToastMsg(data.message || 'Failed to remove item!');
            }
        },
        error: function() {
            showToastMsg('Failed to remove item!');
        }
    });
}

function checkCartEmpty() {
    var $tbody = $('.cart-table tbody');
    if ($tbody.length && $tbody.find('tr').length === 0) {
        location.reload();
    }
}

function clearCart() {
    if (!confirm('Are you sure you want to clear your cart?')) return;

    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '/cart/clear',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        success: function(data) {
            if (data.success) {
                showToastMsg(data.message);
                setTimeout(function() {
                    location.reload();
                }, 1000);
            }
        },
        error: function() {
            showToastMsg('Failed to clear cart!');
        }
    });
}

// ========== Wishlist Toggle ==========
window.toggleWishlist = function(btn) {
    var $btn = $(btn);
    var $icon = $btn.find('i');

    if ($icon.hasClass('bi-heart')) {
        $icon.removeClass('bi-heart').addClass('bi-heart-fill');
        $btn.addClass('wishlist-active');
        showToastMsg('Added to wishlist!');
    } else {
        $icon.removeClass('bi-heart-fill').addClass('bi-heart');
        $btn.removeClass('wishlist-active');
        showToastMsg('Removed from wishlist');
    }
};

// ========== Product Image Gallery ==========
window.changeImage = function(thumbnail, imageUrl) {
    var $thumbnail = $(thumbnail);
    var $mainImage = $('#mainProductImage');

    if ($mainImage.length) {
        $mainImage.css('opacity', 0);
        $mainImage.attr('src', imageUrl);
        setTimeout(function() {
            $mainImage.css('opacity', 1);
        }, 100);
    }

    $('.thumbnail').removeClass('active');
    $thumbnail.addClass('active');
};

// ========== Quantity Selector ==========
window.updateQty = function(change) {
    var $input = $('#productQty');
    if (!$input.length) return;

    var value = parseInt($input.val()) + change;
    if (value < 1) value = 1;
    if (value > 10) value = 10;
    $input.val(value);
};

// ========== Password Toggle ==========
window.togglePassword = function(inputId, btn) {
    var $input = $('#' + inputId);
    var $icon = $(btn).find('i');

    if ($input.attr('type') === 'password') {
        $input.attr('type', 'text');
        $icon.attr('class', 'bi bi-eye-slash');
    } else {
        $input.attr('type', 'password');
        $icon.attr('class', 'bi bi-eye');
    }
};

// ========== Price Range Slider ==========
function initPriceRange() {
    var $priceRange = $('#priceRange');
    var $priceValue = $('#priceValue');

    if ($priceRange.length && $priceValue.length) {
        $priceRange.on('input', function() {
            $priceValue.text('$' + parseInt($(this).val()).toLocaleString());
        });
    }
}

// ========== Countdown Timer ==========
function initCountdown() {
    var $countdownTimers = $('.countdown-timer');
    if (!$countdownTimers.length) return;

    function updateTimers() {
        $countdownTimers.each(function() {
            var $timer = $(this);
            var $daysEl = $timer.find('[data-days]');
            var $hoursEl = $timer.find('[data-hours]');
            var $minutesEl = $timer.find('[data-minutes]');
            var $secondsEl = $timer.find('[data-seconds]');

            if (!$secondsEl.length) return;

            var seconds = parseInt($secondsEl.text());
            var minutes = parseInt($minutesEl.text());
            var hours = parseInt($hoursEl.text());
            var days = parseInt($daysEl.text());

            seconds--;

            if (seconds < 0) {
                seconds = 59;
                minutes--;
                if (minutes < 0) {
                    minutes = 59;
                    hours--;
                    if (hours < 0) {
                        hours = 23;
                        days--;
                        if (days < 0) {
                            days = 0;
                            hours = 0;
                            minutes = 0;
                            seconds = 0;
                        }
                    }
                }
            }

            $daysEl.text(days < 10 ? '0' + days : days);
            $hoursEl.text(hours < 10 ? '0' + hours : hours);
            $minutesEl.text(minutes < 10 ? '0' + minutes : minutes);
            $secondsEl.text(seconds < 10 ? '0' + seconds : seconds);
        });
    }

    setInterval(updateTimers, 1000);
}

// ========== Payment Method Toggle ==========
function initPaymentToggle() {
    var $paymentOptions = $('.payment-option');

    $paymentOptions.each(function() {
        var $option = $(this);
        var $radio = $option.find('input[type="radio"]');

        if ($radio.length) {
            $radio.on('change', function() {
                $paymentOptions.removeClass('selected');
                $option.addClass('selected');

                var $cardDetails = $('#cardDetails');
                if ($cardDetails.length) {
                    $cardDetails.toggle(this.id === 'payCard');
                }
            });
        }
    });
}

// ========== Search Functionality ==========
$('.btn-search').on('click', function() {
    var $input = $(this).closest('.search-bar').find('input');
    if ($input.length && $.trim($input.val())) {
        showToastMsg('Searching for "' + $input.val() + '"...');
    }
});

$('.search-bar input').on('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        var $btn = $(this).closest('.search-bar').find('.btn-search');
        if ($btn.length) $btn.click();
    }
});

// ========== Newsletter Subscribe ==========
$('.newsletter-form .btn').on('click', function() {
    var $input = $(this).closest('.newsletter-form').find('input');
    if ($input.length && $.trim($input.val()) && $input.val().includes('@')) {
        showToastMsg('Thank you for subscribing!');
        $input.val('');
    } else {
        showToastMsg('Please enter a valid email address');
    }
});

// ========== Smooth Scroll ==========
$('a[href^="#"]').on('click', function(e) {
    var target = $($(this).attr('href'));
    if (target.length) {
        e.preventDefault();
        $('html, body').animate({ scrollTop: target.offset().top }, 300);
    }
});

// ========== Lazy Load Images ==========
if ('IntersectionObserver' in window) {
    var imageObserver = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                var $img = $(entry.target);
                if ($img.data('src')) {
                    $img.attr('src', $img.data('src')).removeAttr('data-src');
                }
                imageObserver.unobserve(entry.target);
            }
        });
    });

    $('img[data-src]').each(function() {
        imageObserver.observe(this);
    });
}

// ========== Add to Cart from Modal ==========
window.addToCartFromModal = function() {
    var modalProductId = $('.quick-view-modal').data('product-id');
    if (modalProductId) {
        addToCart(parseInt(modalProductId));
    } else {
        showToastMsg('Please view the product page to add to cart.');
    }
};

// ========== Console Branding ==========
console.log(
    '%c ElectroMart %c v1.0.0 ',
    'background: #2563eb; color: white; font-size: 14px; padding: 4px 8px; border-radius: 4px 0 0 4px; font-weight: bold;',
    'background: #1e293b; color: white; font-size: 14px; padding: 4px 8px; border-radius: 0 4px 4px 0;'
);
