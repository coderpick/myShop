   <aside class="admin-sidebar" id="adminSidebar">
       <!-- Sidebar Brand -->
       <div class="sidebar-brand">
           <div class="brand-icon">
               <i class="bi bi-lightning-charge-fill"></i>
           </div>
           <span class="brand-text">ElectroMart</span>
       </div>

       <!-- Sidebar Navigation -->
       <div class="sidebar-menu">
           <!-- Main Menu -->
           <div class="sidebar-menu-title">Main Menu</div>
           <ul class="sidebar-nav">
               <li class="sidebar-nav-item">
                   <a href="{{ route('admin.dashboard') }}"
                       class="sidebar-nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                       <i class="bi bi-grid-1x2-fill"></i>
                       <span class="nav-text">Dashboard</span>
                   </a>
               </li>
           </ul>

           <!-- Store Management -->
           <div class="sidebar-menu-title">Store Management</div>
           <ul class="sidebar-nav">
               <li class="sidebar-nav-item">
                   <a href="{{ route('admin.category.index') }}"
                       class="sidebar-nav-link {{ Request::is('admin/category*') ? 'active' : '' }}">
                       <i class="bi bi-tags"></i>
                       <span class="nav-text">Categories</span>
                   </a>
               </li>
               <li class="sidebar-nav-item">
                   <a href="{{ route('admin.sub_category.index') }}"
                       class="sidebar-nav-link {{ Request::is('admin/sub_category*') ? 'active' : '' }}">
                       <i class="bi bi-tags"></i>
                       <span class="nav-text">Sub Categories</span>
                   </a>
               </li>
               <li class="sidebar-nav-item">
                   <a href="#productSubmenu" class="sidebar-nav-link" data-bs-toggle="collapse" aria-expanded="false">
                       <i class="bi bi-box-seam"></i>
                       <span class="nav-text">Products</span>
                       <i class="bi bi-chevron-right arrow"></i>
                   </a>
                   <ul class="sidebar-submenu collapse" id="productSubmenu">
                       <li><a href="products.html" class="sidebar-nav-link"><span class="nav-text">All
                                   Products</span></a></li>
                       <li><a href="add-product.html" class="sidebar-nav-link"><span class="nav-text">Add
                                   Product</span></a></li>
                   </ul>
               </li>

               <li class="sidebar-nav-item">
                   <a href="orders.html" class="sidebar-nav-link">
                       <i class="bi bi-cart-check"></i>
                       <span class="nav-text">Orders</span>
                       <span class="badge bg-danger nav-text">12</span>
                   </a>
               </li>
               <li class="sidebar-nav-item">
                   <a href="customers.html" class="sidebar-nav-link">
                       <i class="bi bi-people"></i>
                       <span class="nav-text">Customers</span>
                   </a>
               </li>
           </ul>

           <!-- Reports -->
           <div class="sidebar-menu-title">Reports & Analytics</div>
           <ul class="sidebar-nav">
               <li class="sidebar-nav-item">
                   <a href="#" class="sidebar-nav-link">
                       <i class="bi bi-bar-chart-line"></i>
                       <span class="nav-text">Sales Report</span>
                   </a>
               </li>
               <li class="sidebar-nav-item">
                   <a href="#" class="sidebar-nav-link">
                       <i class="bi bi-graph-up-arrow"></i>
                       <span class="nav-text">Analytics</span>
                   </a>
               </li>
           </ul>

           <!-- Settings -->
           <div class="sidebar-menu-title">Settings</div>
           <ul class="sidebar-nav">
               <li class="sidebar-nav-item">
                   <a href="#" class="sidebar-nav-link">
                       <i class="bi bi-gear"></i>
                       <span class="nav-text">General Settings</span>
                   </a>
               </li>
               <li class="sidebar-nav-item">
                   <a href="#" class="sidebar-nav-link">
                       <i class="bi bi-shield-check"></i>
                       <span class="nav-text">Roles & Permissions</span>
                   </a>
               </li>
               <li class="sidebar-nav-item">
                   <a href="#" class="sidebar-nav-link">
                       <i class="bi bi-folder2-open"></i>
                       <span class="nav-text">File Manager</span>
                   </a>
               </li>
           </ul>
       </div>

       <!-- Sidebar User -->
       <div class="sidebar-user">
           <div class="sidebar-user-avatar">AD</div>
           <div class="sidebar-user-info">
               <div class="user-name">Admin User</div>
               <div class="user-role">Super Admin</div>
           </div>
       </div>
   </aside>
