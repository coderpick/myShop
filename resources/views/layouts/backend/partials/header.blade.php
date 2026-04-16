         <header class="admin-topbar" id="adminTopbar">
             <div class="topbar-left">
                 <!-- Sidebar Toggle Button -->
                 <button class="sidebar-toggle" id="sidebarToggle">
                     <i class="bi bi-list"></i>
                 </button>

                 <!-- Search -->
                 <div class="topbar-search d-none d-md-block">
                     <i class="bi bi-search search-icon"></i>
                     <input type="text" placeholder="Search anything...">
                 </div>
             </div>

             <div class="topbar-right">
                 <!-- Dark Mode Toggle -->
                 <button class="topbar-btn" id="themeToggle" title="Toggle Theme">
                     <i class="bi bi-moon-fill"></i>
                 </button>

                 <!-- Notifications -->
                 <div class="dropdown">
                     <button class="topbar-btn" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                         <i class="bi bi-bell"></i>
                         <span class="badge-count">5</span>
                     </button>
                     <div class="dropdown-menu dropdown-menu-end notification-dropdown shadow-lg">
                         <div class="notification-header">
                             <h6>Notifications</h6>
                             <a href="#" class="text-primary small">Mark all read</a>
                         </div>
                         <div class="notification-item unread">
                             <div class="notif-icon bg-primary bg-opacity-10 text-primary">
                                 <i class="bi bi-cart-check"></i>
                             </div>
                             <div>
                                 <div class="notif-text"><strong>New order #1234</strong> has been placed by John Doe
                                 </div>
                                 <div class="notif-time">2 minutes ago</div>
                             </div>
                         </div>
                         <div class="notification-item unread">
                             <div class="notif-icon bg-success bg-opacity-10 text-success">
                                 <i class="bi bi-person-plus"></i>
                             </div>
                             <div>
                                 <div class="notif-text"><strong>New customer</strong> Sarah Miller registered</div>
                                 <div class="notif-time">15 minutes ago</div>
                             </div>
                         </div>
                         <div class="notification-item">
                             <div class="notif-icon bg-warning bg-opacity-10 text-warning">
                                 <i class="bi bi-exclamation-triangle"></i>
                             </div>
                             <div>
                                 <div class="notif-text"><strong>Low stock alert:</strong> iPhone 15 Pro only 3 left
                                 </div>
                                 <div class="notif-time">1 hour ago</div>
                             </div>
                         </div>
                         <div class="notification-item">
                             <div class="notif-icon bg-danger bg-opacity-10 text-danger">
                                 <i class="bi bi-x-circle"></i>
                             </div>
                             <div>
                                 <div class="notif-text"><strong>Order #1228</strong> has been cancelled</div>
                                 <div class="notif-time">3 hours ago</div>
                             </div>
                         </div>
                         <div class="p-2 text-center border-top">
                             <a href="#" class="text-primary small fw-600">View All Notifications</a>
                         </div>
                     </div>
                 </div>

                 <!-- Messages -->
                 <button class="topbar-btn" title="Messages">
                     <i class="bi bi-chat-dots"></i>
                     <span class="notification-dot"></span>
                 </button>

                 <div class="topbar-divider d-none d-md-block"></div>

                 <!-- User Dropdown -->
                 <div class="dropdown">
                     <div class="topbar-user" data-bs-toggle="dropdown">
                         <div class="topbar-user-avatar">AD</div>
                         <div class="topbar-user-info d-none d-md-block">
                             <div class="name">Admin User</div>
                             <div class="role">Super Admin</div>
                         </div>
                         <i class="bi bi-chevron-down ms-1 d-none d-md-inline"
                             style="font-size: 0.625rem; color: var(--admin-gray-500);"></i>
                     </div>
                     <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                         <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> My Profile</a>
                         </li>
                         <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i> Settings</a>
                         </li>
                         <li><a class="dropdown-item" href="#"><i class="bi bi-activity me-2"></i> Activity
                                 Log</a></li>
                         <li>
                             <hr class="dropdown-divider">
                         </li>
                         <li>
                             <a class="dropdown-item text-danger"  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                 <i class="bi bi-box-arrow-right me-2"></i> Logout
                             </a>

                         </li>
                         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                             @csrf
                         </form>
                     </ul>
                 </div>
             </div>
         </header>
