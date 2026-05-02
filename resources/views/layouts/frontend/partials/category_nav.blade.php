<div class="category-nav d-none d-lg-block">
    <div class="container">
        <ul class="nav justify-content-center">
            <li class="nav-item dropdown dropdown-mega dropdown-hover">
                <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-grid"></i> All Categories
                </a>
                <div class="dropdown-menu mega-menu shadow-lg border-0 p-4" aria-labelledby="categoryDropdown">
                    <div class="row g-4">
                        @forelse ($categoriesWithSub as $category)
                            <div class="col-lg-3">
                                <h6 class="dropdown-header fw-bold text-primary mb-2 ps-0">{{ $category->name }}</h6>
                                <ul class="list-unstyled">
                                    @forelse($category->subCategories as $subCategory)
                                        <li><a class="dropdown-item rounded"
                                                href="{{ route('shop.subcategory', $subCategory->slug) }}">{{ $subCategory->name }}</a>
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                        @empty
                        @endforelse

                    </div>
                </div>
            </li>
            @forelse ($navCategories as $navCategory)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shop.category', $navCategory->slug) }}"><i
                            class="{{ $navCategory->icon }}"></i> {{ $navCategory->name }}</a>
                </li>
            @empty
            @endforelse


            <li class="nav-item">
                <a class="nav-link text-warning" href="#"><i class="bi bi-lightning"></i> Deals</a>
            </li>
        </ul>
    </div>
</div>
