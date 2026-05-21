<div class="category-nav d-none d-lg-block">
    <div class="container">
        <ul class="nav justify-content-center">
            <li class="nav-item dropdown-vertical-wrap">
                <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button">
                    <i class="bi bi-grid-3x3-gap-fill"></i> All Categories
                </a>
                <div class="vertical-menu shadow-lg" id="verticalCategoryMenu">
                    <ul class="vertical-menu-list">
                        @forelse ($categoriesWithSub as $category)
                            <li class="vertical-menu-item {{ $category->subCategories->count() ? 'has-submenu' : '' }}">
                                <a href="{{ route('shop.category', $category->slug) }}" class="vertical-menu-link">
                                    @if($category->icon)
                                        <i class="{{ $category->icon }} me-2"></i>
                                    @else
                                        <i class="bi bi-tag me-2"></i>
                                    @endif
                                    <span>{{ $category->name }}</span>
                                    @if($category->subCategories->count())
                                        <i class="bi bi-chevron-right submenu-arrow"></i>
                                    @endif
                                </a>
                                @if($category->subCategories->count())
                                    <div class="vertical-submenu shadow-lg">
                                        <h6 class="submenu-title">{{ $category->name }}</h6>
                                        <ul class="submenu-list">
                                            @foreach($category->subCategories as $subCategory)
                                                <li>
                                                    <a href="{{ route('shop.subcategory', $subCategory->slug) }}" class="submenu-link">
                                                        {{ $subCategory->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </li>
                        @empty
                            <li class="vertical-menu-item">
                                <span class="vertical-menu-link text-muted">No categories found</span>
                            </li>
                        @endforelse
                    </ul>
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
