  <div class="offcanvas offcanvas-start" id="mobileMenu">
      <div class="offcanvas-header">
          <h5 class="offcanvas-title fw-bold">
              <i class="bi bi-lightning-charge-fill text-primary me-2"></i>ElectroMart
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
      </div>
      <div class="offcanvas-body">
          <!-- Mobile Search -->
          <div class="search-bar mb-3" style="display: flex !important; max-width: 100%;">
              <input type="text" class="form-control" placeholder="Search products...">
              <button class="btn-search" type="button">
                  <i class="bi bi-search"></i>
              </button>
          </div>

          <ul class="list-group list-group-flush">
              <a href="{{ uri('/') }}" class="list-group-item list-group-item-action"><i
                      class="bi bi-house me-2"></i>
                  Home</a>
              @forelse ($navCategories as $category)
                  <a href="{{ route('shop.category', $category->slug) }}"
                      class="list-group-item list-group-item-action">
                      <i class="bi bi-{{ $category->icon }} me-2"></i>
                      {{ $category->name }}</a>
              @empty
              @endforelse

              <a href="" class="list-group-item list-group-item-action"><i class="bi bi-lightning me-2"></i>
                  Deals</a>
              <a href="{{ route('cart.index') }}" class="list-group-item list-group-item-action"><i
                      class="bi bi-cart3 me-2"></i>
                  Cart</a>
              @auth
                  <a href="{{ route('customer.dashboard') }}" class="list-group-item list-group-item-action"><i
                          class="bi bi-person me-2"></i>
                      Dashbaord
                  </a>
                  <form action="{{ route('logout') }}" method="post">
                      @csrf
                      <button type="submit" class="list-group-item list-group-item-action"><i
                              class="bi bi-person me-2"></i>
                          Logout</button>
                  </form>
              @else
                  <a href="{{ route('login') }}" class="list-group-item list-group-item-action"><i
                          class="bi bi-person me-2"></i>
                      Login</a>
              @endauth
          </ul>
      </div>
  </div>
