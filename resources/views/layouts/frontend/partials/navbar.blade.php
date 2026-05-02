   <nav class="navbar navbar-expand-lg navbar-main sticky-top">
       <div class="container">
           <!-- Logo -->
           <a class="navbar-brand" href="{{ uri('/') }}">
               <i class="bi bi-lightning-charge-fill"></i>
               ElectroMart
           </a>
           <!-- Search Bar (Desktop) -->
           <div class="search-bar d-none d-lg-flex mx-4">
               <input type="text" class="form-control" placeholder="Search for products, brands, and more...">
               <button class="btn-search" type="button">
                   <i class="bi bi-search"></i>
               </button>
           </div>

           <!-- Nav Icons -->
           <div class="d-flex align-items-center nav-icons">
               <!-- Dark Mode Toggle -->
               <button class="dark-mode-toggle" id="darkModeToggle" title="Toggle Dark Mode">
                   <i class="bi bi-moon-fill"></i>
               </button>

               <!-- Wishlist -->
               <a href="#" class="nav-link d-none d-md-block">
                   <i class="bi bi-heart"></i>
               </a>

               <!-- Account -->
               <div class="dropdown">
                   <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                       <i class="bi bi-person"></i>
                   </a>
                   <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                       @guest
                           <li><a class="dropdown-item" href="{{ route('login') }}"><i
                                       class="bi bi-box-arrow-in-right me-2"></i>Login</a></li>
                           <li><a class="dropdown-item" href="{{ route('register') }}"><i
                                       class="bi bi-person-plus me-2"></i>Register</a>
                           </li>
                       @else
                           <li>
                               <a href="#" class="dropdown-item"
                                   disabled><strong>{{ Auth::user()->name }}</strong></a>
                           </li>
                           <li><a class="dropdown-item" href="#"><i class="bi bi-bag me-2"></i>My Orders</a></li>
                           <li><a class="dropdown-item" href="#"><i class="bi bi-heart me-2"></i>Wishlist</a></li>
                           <li>
                               <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                   <i class="bi bi-box-arrow-left me-2"></i>Logout
                               </a>
                           </li>
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                               @csrf
                           </form>
                       @endguest
                   </ul>
               </div>

               <!-- Cart -->
               <a href="{{ route('cart.index') }}" class="nav-link">
                   <i class="bi bi-cart3"></i>
                   <span class="badge-cart" id="cartCount">{{ count((array) session('cart', [])) }}</span>
               </a>

               <!-- Mobile Toggle -->
               <button class="navbar-toggler border-0 ms-2" type="button" data-bs-toggle="offcanvas"
                   data-bs-target="#mobileMenu">
                   <i class="bi bi-list fs-4"></i>
               </button>
           </div>
       </div>
   </nav>
