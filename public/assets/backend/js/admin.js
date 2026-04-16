/* ============================================
   ElectroMart Admin Panel - JavaScript
   ============================================ */

document.addEventListener('DOMContentLoaded', function () {
    initSidebar();
    initThemeToggle();
    initUploadZone();
    initSelectAll();
    initSubmenus();
});

/* ========== Sidebar Toggle ========== */
function initSidebar() {
    const sidebar = document.getElementById('adminSidebar');
    const main = document.getElementById('adminMain');
    const topbar = document.getElementById('adminTopbar');
    const toggle = document.getElementById('sidebarToggle');
    const overlay = document.getElementById('sidebarOverlay');

    if (!toggle || !sidebar) return;

    toggle.addEventListener('click', function () {
        const isMobile = window.innerWidth < 992;

        if (isMobile) {
            // Mobile: show/hide with overlay
            sidebar.classList.toggle('show');
            if (overlay) overlay.classList.toggle('show');
        } else {
            // Desktop: collapse
            sidebar.classList.toggle('collapsed');
            if (main) main.classList.toggle('sidebar-collapsed');
            if (topbar) topbar.classList.toggle('sidebar-collapsed');

            // Save preference
            localStorage.setItem('sidebarCollapsed',
                sidebar.classList.contains('collapsed') ? 'true' : 'false'
            );
        }
    });

    // Close sidebar on overlay click (mobile)
    if (overlay) {
        overlay.addEventListener('click', function () {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
    }

    // Restore sidebar state
    if (window.innerWidth >= 992) {
        const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        if (isCollapsed) {
            sidebar.classList.add('collapsed');
            if (main) main.classList.add('sidebar-collapsed');
            if (topbar) topbar.classList.add('sidebar-collapsed');
        }
    }

    // Handle window resize
    window.addEventListener('resize', function () {
        if (window.innerWidth >= 992) {
            sidebar.classList.remove('show');
            if (overlay) overlay.classList.remove('show');
        }
    });
}

/* ========== Sidebar Submenus ========== */
function initSubmenus() {
    const submenuToggles = document.querySelectorAll('[data-bs-toggle="collapse"]');
    submenuToggles.forEach(function (toggle) {
        const target = document.querySelector(toggle.getAttribute('href') || toggle.getAttribute('data-bs-target'));
        if (!target) return;

        // Set initial arrow state
        if (target.classList.contains('show')) {
            toggle.setAttribute('aria-expanded', 'true');
        }

        // Listen for collapse events
        target.addEventListener('show.bs.collapse', function () {
            toggle.setAttribute('aria-expanded', 'true');
        });

        target.addEventListener('hide.bs.collapse', function () {
            toggle.setAttribute('aria-expanded', 'false');
        });
    });
}

/* ========== Dark Mode / Theme Toggle ========== */
function initThemeToggle() {
    const themeToggle = document.getElementById('themeToggle');
    if (!themeToggle) return;

    // Load saved theme
    const savedTheme = localStorage.getItem('adminTheme') || 'light';
    document.documentElement.setAttribute('data-admin-theme', savedTheme);
    updateThemeIcon(themeToggle, savedTheme);

    themeToggle.addEventListener('click', function () {
        const current = document.documentElement.getAttribute('data-admin-theme');
        const newTheme = current === 'dark' ? 'light' : 'dark';

        document.documentElement.setAttribute('data-admin-theme', newTheme);
        localStorage.setItem('adminTheme', newTheme);
        updateThemeIcon(themeToggle, newTheme);
    });
}

function updateThemeIcon(btn, theme) {
    const icon = btn.querySelector('i');
    if (!icon) return;

    if (theme === 'dark') {
        icon.className = 'bi bi-sun-fill';
    } else {
        icon.className = 'bi bi-moon-fill';
    }
}

/* ========== File Upload Zone ========== */
function initUploadZone() {
    const uploadZone = document.getElementById('uploadZone');
    const fileInput = document.getElementById('imageUpload');

    if (!uploadZone || !fileInput) return;

    // Click to open file dialog
    uploadZone.addEventListener('click', function () {
        fileInput.click();
    });

    // Drag and Drop
    uploadZone.addEventListener('dragover', function (e) {
        e.preventDefault();
        this.style.borderColor = 'var(--admin-primary)';
        this.style.background = 'var(--admin-primary-bg)';
    });

    uploadZone.addEventListener('dragleave', function (e) {
        e.preventDefault();
        this.style.borderColor = '';
        this.style.background = '';
    });

    uploadZone.addEventListener('drop', function (e) {
        e.preventDefault();
        this.style.borderColor = '';
        this.style.background = '';
        // Handle files
        const files = e.dataTransfer.files;
        handleFileUpload(files);
    });

    fileInput.addEventListener('change', function () {
        handleFileUpload(this.files);
    });
}

function handleFileUpload(files) {
    const previewGrid = document.getElementById('imagePreviewGrid');
    if (!previewGrid) return;

    Array.from(files).forEach(function (file) {
        if (!file.type.startsWith('image/')) return;

        const reader = new FileReader();
        reader.onload = function (e) {
            const item = document.createElement('div');
            item.className = 'image-preview-item';
            item.innerHTML = `
                <img src="${e.target.result}" alt="Preview">
                <button type="button" class="remove-btn" onclick="this.parentElement.remove()">
                    <i class="bi bi-x"></i>
                </button>
            `;
            previewGrid.appendChild(item);
        };
        reader.readAsDataURL(file);
    });
}

/* ========== Select All Checkbox ========== */
function initSelectAll() {
    const selectAll = document.getElementById('selectAll');
    if (!selectAll) return;

    selectAll.addEventListener('change', function () {
        const checkboxes = document.querySelectorAll('.admin-table tbody .form-check-input');
        checkboxes.forEach(function (cb) {
            cb.checked = selectAll.checked;
        });
    });
}

/* ========== Show Alert ========== */
function showAlert(message, type) {
    type = type || 'success';
    const alertEl = document.getElementById('successAlert');
    const msgEl = document.getElementById('alertMessage');

    if (!alertEl || !msgEl) {
        // Create alert dynamically if not found
        const alertHTML = `
            <div class="alert alert-${type} alert-dismissible fade show d-flex align-items-center" role="alert">
                <i class="bi bi-${type === 'success' ? 'check-circle-fill' : 'exclamation-triangle-fill'} me-2"></i>
                <span>${message}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;

        const content = document.querySelector('.admin-content');
        const pageHeader = content ? content.querySelector('.page-header') : null;

        if (pageHeader) {
            pageHeader.insertAdjacentHTML('afterend', alertHTML);
        }
        return;
    }

    msgEl.textContent = message;
    alertEl.className = `alert alert-${type} alert-dismissible fade show d-flex align-items-center`;
    alertEl.style.display = '';
    alertEl.classList.remove('d-none');

    // Auto dismiss after 5 seconds
    setTimeout(function () {
        const bsAlert = bootstrap.Alert.getOrCreateInstance(alertEl);
        if (bsAlert) bsAlert.close();
    }, 5000);
}

/* ========== Utility: Format Currency ========== */
function formatCurrency(amount) {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD'
    }).format(amount);
}

/* ========== Utility: Format Date ========== */
function formatDate(dateStr) {
    const options = { year: 'numeric', month: 'short', day: 'numeric' };
    return new Date(dateStr).toLocaleDateString('en-US', options);
}

/* ========== Console Branding ========== */
console.log(
    '%c ElectroMart Admin %c v1.0.0 ',
    'background: #4f46e5; color: white; font-size: 14px; padding: 4px 8px; border-radius: 4px 0 0 4px; font-weight: bold;',
    'background: #1e293b; color: white; font-size: 14px; padding: 4px 8px; border-radius: 0 4px 4px 0;'
);