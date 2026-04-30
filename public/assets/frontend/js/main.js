/* ============================================
   ElectroMart - Main JavaScript
   ============================================ */

// ========== DOM Ready ==========
document.addEventListener("DOMContentLoaded", function () {
  initDarkMode();
  initBackToTop();
  initNavbarScroll();
  initPriceRange();
  initCountdown();
  initPaymentToggle();
});

// ========== Dark Mode Toggle ==========
function initDarkMode() {
  const toggle = document.getElementById("darkModeToggle");
  if (!toggle) return;

  // Check saved preference
  const savedTheme = localStorage.getItem("theme") || "light";
  document.documentElement.setAttribute("data-theme", savedTheme);
  updateDarkModeIcon(toggle, savedTheme);

  toggle.addEventListener("click", function () {
    const currentTheme = document.documentElement.getAttribute("data-theme");
    const newTheme = currentTheme === "dark" ? "light" : "dark";

    document.documentElement.setAttribute("data-theme", newTheme);
    localStorage.setItem("theme", newTheme);
    updateDarkModeIcon(toggle, newTheme);
  });
}

function updateDarkModeIcon(toggle, theme) {
  const icon = toggle.querySelector("i");
  if (theme === "dark") {
    icon.className = "bi bi-sun-fill";
  } else {
    icon.className = "bi bi-moon-fill";
  }
}

// ========== Back to Top Button ==========
function initBackToTop() {
  const backToTopBtn = document.getElementById("backToTop");
  if (!backToTopBtn) return;

  window.addEventListener("scroll", function () {
    if (window.scrollY > 300) {
      backToTopBtn.classList.add("show");
    } else {
      backToTopBtn.classList.remove("show");
    }
  });

  backToTopBtn.addEventListener("click", function () {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });
}

// ========== Navbar Scroll Effect ==========
function initNavbarScroll() {
  const navbar = document.querySelector(".navbar-main");
  if (!navbar) return;

  window.addEventListener("scroll", function () {
    if (window.scrollY > 50) {
      navbar.classList.add("scrolled");
    } else {
      navbar.classList.remove("scrolled");
    }
  });
}

// ========== Add to Cart ==========
function addToCart(productName) {
  // Get current cart count
  const cartCountEl = document.getElementById("cartCount");
  if (cartCountEl) {
    let count = parseInt(cartCountEl.textContent) || 0;
    count++;
    cartCountEl.textContent = count;

    // Add animation
    cartCountEl.style.transform = "scale(1.5)";
    setTimeout(() => {
      cartCountEl.style.transform = "scale(1)";
    }, 200);
  }

  // Show toast notification
  showToastMsg(`${productName} added to cart!`);
}

// ========== Toast Notification ==========
function showToastMsg(message) {
  const toastEl = document.getElementById("cartToast");
  const toastMsg = document.getElementById("toastMessage");

  if (toastEl && toastMsg) {
    toastMsg.textContent = message;
    const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
    toast.show();
  }
}

// ========== Wishlist Toggle ==========
function toggleWishlist(btn) {
  const icon = btn.querySelector("i");

  if (icon.classList.contains("bi-heart")) {
    icon.classList.remove("bi-heart");
    icon.classList.add("bi-heart-fill");
    btn.classList.add("wishlist-active");
    showToastMsg("Added to wishlist!");
  } else {
    icon.classList.remove("bi-heart-fill");
    icon.classList.add("bi-heart");
    btn.classList.remove("wishlist-active");
    showToastMsg("Removed from wishlist");
  }
}

// ========== Product Image Gallery ==========
function changeImage(thumbnail, imageUrl) {
  // Update main image
  const mainImage = document.getElementById("mainProductImage");
  if (mainImage) {
    mainImage.src = imageUrl;

    // Add fade effect
    mainImage.style.opacity = "0";
    setTimeout(() => {
      mainImage.style.opacity = "1";
    }, 100);
  }

  // Update active thumbnail
  document
    .querySelectorAll(".thumbnail")
    .forEach((t) => t.classList.remove("active"));
  thumbnail.classList.add("active");
}

// ========== Quantity Selector (Product Page) ==========
function updateQty(change) {
  const input = document.getElementById("productQty");
  if (!input) return;

  let value = parseInt(input.value) + change;
  if (value < 1) value = 1;
  if (value > 10) value = 10;
  input.value = value;
}

// ========== Cart Quantity Update ==========
function updateCartQty(btn, change) {
  const container = btn.closest(".quantity-selector");
  const input = container.querySelector("input");

  let value = parseInt(input.value) + change;
  if (value < 1) value = 1;
  if (value > 10) value = 10;
  input.value = value;

  // Here you would normally update prices
  showToastMsg("Cart updated!");
}

// ========== Remove Cart Item ==========
function removeCartItem(btn) {
  const row = btn.closest("tr");

  // Add fade out animation
  row.style.transition = "opacity 0.3s ease, transform 0.3s ease";
  row.style.opacity = "0";
  row.style.transform = "translateX(-20px)";

  setTimeout(() => {
    row.remove();

    // Update cart count
    const cartCountEl = document.getElementById("cartCount");
    if (cartCountEl) {
      let count = parseInt(cartCountEl.textContent) || 0;
      if (count > 0) count--;
      cartCountEl.textContent = count;
    }

    showToastMsg("Item removed from cart");
  }, 300);
}

// ========== Clear Cart ==========
function clearCart() {
  if (confirm("Are you sure you want to clear your cart?")) {
    const tbody = document.querySelector(".cart-table tbody");
    if (tbody) {
      tbody.innerHTML = `
        <tr>
          <td colspan="5" class="text-center py-5">
            <i class="bi bi-cart-x fs-1 text-muted d-block mb-3"></i>
            <h5 class="text-muted">Your cart is empty</h5>
            <a href="shop.html" class="btn btn-primary-custom mt-2">Continue Shopping</a>
          </td>
        </tr>
      `;
    }

    const cartCountEl = document.getElementById("cartCount");
    if (cartCountEl) cartCountEl.textContent = "0";

    showToastMsg("Cart cleared");
  }
}

// ========== Price Range Slider ==========
function initPriceRange() {
  const priceRange = document.getElementById("priceRange");
  const priceValue = document.getElementById("priceValue");

  if (priceRange && priceValue) {
    priceRange.addEventListener("input", function () {
      priceValue.textContent = "$" + parseInt(this.value).toLocaleString();
    });
  }
}

// ========== Countdown Timer ==========
function initCountdown() {
  const countdownTimers = document.querySelectorAll(".countdown-timer");

  if (countdownTimers.length === 0) return;

  function updateTimers() {
    countdownTimers.forEach((timer) => {
      const daysEl = timer.querySelector("[data-days]");
      const hoursEl = timer.querySelector("[data-hours]");
      const minutesEl = timer.querySelector("[data-minutes]");
      const secondsEl = timer.querySelector("[data-seconds]");

      if (!secondsEl) return;

      let seconds = parseInt(secondsEl.textContent);
      let minutes = parseInt(minutesEl.textContent);
      let hours = parseInt(hoursEl.textContent);
      let days = parseInt(daysEl.textContent);

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

      daysEl.textContent = String(days).padStart(2, "0");
      hoursEl.textContent = String(hours).padStart(2, "0");
      minutesEl.textContent = String(minutes).padStart(2, "0");
      secondsEl.textContent = String(seconds).padStart(2, "0");
    });
  }

  setInterval(updateTimers, 1000);
}

// ========== Password Toggle ==========
function togglePassword(inputId, btn) {
  const input = document.getElementById(inputId);
  const icon = btn.querySelector("i");

  if (input.type === "password") {
    input.type = "text";
    icon.className = "bi bi-eye-slash";
  } else {
    input.type = "password";
    icon.className = "bi bi-eye";
  }
}

// ========== Payment Method Toggle ==========
function initPaymentToggle() {
  const paymentOptions = document.querySelectorAll(".payment-option");

  paymentOptions.forEach((option) => {
    const radio = option.querySelector('input[type="radio"]');
    if (radio) {
      radio.addEventListener("change", function () {
        // Remove selected class from all
        paymentOptions.forEach((opt) => opt.classList.remove("selected"));
        // Add to current
        option.classList.add("selected");

        // Toggle card details visibility
        const cardDetails = document.getElementById("cardDetails");
        if (cardDetails) {
          cardDetails.style.display = this.id === "payCard" ? "block" : "none";
        }
      });
    }
  });
}

// ========== Place Order ==========
function placeOrder(event) {
  event.preventDefault();

  // Simple validation
  const form = document.getElementById("checkoutForm");
  if (!form) return;

  // Show success
  const btn = event.target.closest("button");
  const originalText = btn.innerHTML;

  btn.innerHTML =
    '<span class="spinner-border spinner-border-sm me-2"></span> Processing...';
  btn.disabled = true;

  setTimeout(() => {
    btn.innerHTML = '<i class="bi bi-check-circle me-2"></i> Order Placed!';
    btn.classList.remove("btn-primary-custom");
    btn.classList.add("btn-success");

    showToastMsg(
      "🎉 Order placed successfully! Thank you for shopping with us.",
    );

    // Reset after delay
    setTimeout(() => {
      btn.innerHTML = originalText;
      btn.classList.remove("btn-success");
      btn.classList.add("btn-primary-custom");
      btn.disabled = false;
    }, 3000);
  }, 2000);
}

// ========== Smooth Scroll for Anchor Links ==========
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    const target = document.querySelector(this.getAttribute("href"));
    if (target) {
      e.preventDefault();
      target.scrollIntoView({ behavior: "smooth", block: "start" });
    }
  });
});

// ========== Search Functionality (Simple) ==========
document.querySelectorAll(".btn-search").forEach((btn) => {
  btn.addEventListener("click", function () {
    const input = this.closest(".search-bar").querySelector("input");
    if (input && input.value.trim()) {
      // In a real app, redirect to search results
      showToastMsg(`Searching for "${input.value}"...`);
    }
  });
});

// Allow Enter key to trigger search
document.querySelectorAll(".search-bar input").forEach((input) => {
  input.addEventListener("keypress", function (e) {
    if (e.key === "Enter") {
      e.preventDefault();
      const btn = this.closest(".search-bar").querySelector(".btn-search");
      if (btn) btn.click();
    }
  });
});

// ========== Newsletter Subscribe ==========
document.querySelectorAll(".newsletter-form .btn").forEach((btn) => {
  btn.addEventListener("click", function () {
    const input = this.closest(".newsletter-form").querySelector("input");
    if (input && input.value.trim() && input.value.includes("@")) {
      showToastMsg("Thank you for subscribing! 🎉");
      input.value = "";
    } else {
      showToastMsg("Please enter a valid email address");
    }
  });
});

// ========== Lazy Load Images (Performance) ==========
if ("IntersectionObserver" in window) {
  const imageObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const img = entry.target;
        if (img.dataset.src) {
          img.src = img.dataset.src;
          img.removeAttribute("data-src");
        }
        observer.unobserve(img);
      }
    });
  });

  document.querySelectorAll("img[data-src]").forEach((img) => {
    imageObserver.observe(img);
  });
}

// ========== Console Branding ==========
console.log(
  "%c ElectroMart %c v1.0.0 ",
  "background: #2563eb; color: white; font-size: 14px; padding: 4px 8px; border-radius: 4px 0 0 4px; font-weight: bold;",
  "background: #1e293b; color: white; font-size: 14px; padding: 4px 8px; border-radius: 0 4px 4px 0;",
);
