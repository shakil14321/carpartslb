@extends('layouts.front.front-layout')

@section('seo')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('content')
    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content text-center">
                        <h1 class="breadcrumb__content--title">Products</h1>
                        <ul class="breadcrumb__content--menu d-flex justify-content-center">
                            <li class="breadcrumb__content--menu__items"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb__content--menu__items"><span>Shop</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->

    <!-- Start shop section -->
    <div class="shop__section section--padding">
        <div class="container">
            <div class="row">

                <div class="col-xl-3 col-lg-4 shop-col-width-lg-4">
                    <div class="shop__sidebar--widget widget__area d-none d-lg-block">

                        {{-- Price filter --}}
                        <div class="single__widget price__filter widget__bg">
                            <h2 class="widget__title h3">Filter By Price</h2>
                            <form id="price-filter-form">
                                <div class="price__filter--form__inner mb-15 d-flex align-items-center">
                                    <div class="price__filter--group">
                                        <label class="price__filter--label" for="Filter-Price-GTE">From</label>
                                        <div class="price__filter--input d-flex align-items-center">
                                            <span class="price__filter--currency">$</span>
                                            <input class="price__filter--input__field border-0 custom_price_field"
                                                name="min_price" id="Filter-Price-GTE" type="number"
                                                placeholder="{{ $minPrice }}" value="{{ $minPrice }}">
                                        </div>
                                    </div>
                                    <div class="price__divider"><span>-</span></div>
                                    <div class="price__filter--group">
                                        <label class="price__filter--label" for="Filter-Price-LTE">To</label>
                                        <div class="price__filter--input d-flex align-items-center">
                                            <span class="price__filter--currency">$</span>
                                            <input class="price__filter--input__field border-0 custom_price_field"
                                                name="max_price" id="Filter-Price-LTE" type="number"
                                                placeholder="{{ $maxPrice }}" value="{{ $maxPrice }}">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="primary__btn price__filter--btn">Filter</button>
                            </form>
                        </div>


                        <div class="single__widget widget__bg">
                            <h2 class="widget__title h3">Categories</h2>
                            <ul class="widget__categories--menu">
                                @if ($carPartTypes)
                                    @foreach ($carPartTypes as $carPartType)
                                        <li class="widget__categories--menu__list">
                                            <a href="{{ route('type.view', $carPartType->slug) }}">
                                                <label class="widget__categories--menu__label d-flex align-items-center">
                                                    <img class="widget__categories--menu__img"
                                                        src="{{ $carPartType->part_type_image
                                                            ? asset('images/types/' . $carPartType->part_type_image)
                                                            : asset('images/types/demo.png') }}"
                                                        alt="categories-img">

                                                    <span
                                                        class="widget__categories--menu__text lh-base">{{ $carPartType->title }}</span>
                                                </label>
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <h5>Categories not found.</h5>
                                @endif
                            </ul>
                        </div>

                        {{-- Top featured products --}}
                        <div class="single__widget widget__bg">
                            <h2 class="widget__title h3">Top Featured Products</h2>
                            <div class="shop__sidebar--product">
                                @if ($carPartsFav->count() > 0)
                                    @foreach ($carPartsFav as $carPartFav)
                                        <div class="small__product--card">
                                            <div class="small__product--thumbnail">
                                                <a class="display-block"
                                                    href="{{ route('product.view', $carPartFav->slug) }}"
                                                    style="height:150px !important;">
                                                    @if ($carPartFav->feature_image)
                                                        <img class="product__card--thumbnail__img product__primary--img"
                                                            src="{{ asset('images/parts/feature/' . $carPartFav->feature_image) }}"
                                                            alt="feature_img"
                                                            style="width:100%; height:100%; object-fit:cover;">
                                                    @else
                                                        <img class="product__card--thumbnail__img product__primary--img"
                                                            src="{{ asset('images/brands/demo.png') }}"
                                                            alt="no-image"
                                                            style="width:100%; height:100%; object-fit:cover;">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="small__product--content">
                                                <h3 class="small__product--card__title">
                                                    <a href="{{ route('product.view', $carPartFav->slug) }}">
                                                        {{ $carPartFav->title ?? '' }}
                                                    </a>
                                                </h3>
                                                <div class="small__product--card__price">
                                                    <span class="current__price">
                                                        {{ '$' . ($carPartFav->sale_price ?? $carPartFav->original_price) }}
                                                    </span>
                                                </div>
                                                {{-- Your rating stars code as it is --}}
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <h5>Products not found</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 shop-col-width-lg-8">
                    @if (session('success'))
                        <div class="alert alert-success message_section">{{ session('success') }}</div>
                    @endif
                    <div class="shop__right--sidebar">
                        <div class="shop__product--wrapper">
                            <div class="shop__header d-flex align-items-center justify-content-between mb-30">
                                <div class="product__view--mode d-flex align-items-center">
                                    <button class="widget__filter--btn d-flex d-lg-none align-items-center" type="button"
                                        data-target="#offcanvas-filter" aria-controls="offcanvas-filter"
                                        aria-expanded="false">
                                        <svg class="widget__filter--btn__icon" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 512 512">
                                            <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="28"
                                                d="M368 128h80M64 128h240M368 384h80M64 384h240M208 256h240M64 256h80" />
                                            <circle cx="336" cy="128" r="28" fill="none"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="28" />
                                            <circle cx="176" cy="256" r="28" fill="none"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="28" />
                                            <circle cx="336" cy="384" r="28" fill="none"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="28" />
                                        </svg>
                                        <span class="widget__filter--btn__text">Filter</span>
                                    </button>
                                    {{-- <button class="widget__filter--btn d-flex d-lg-none align-items-center" data-offcanvas>
                                        <svg class="widget__filter--btn__icon" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 512 512">
                                            <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="28"
                                                d="M368 128h80M64 128h240M368 384h80M64 384h240M208 256h240M64 256h80" />
                                            <circle cx="336" cy="128" r="28" fill="none"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="28" />
                                            <circle cx="176" cy="256" r="28" fill="none"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="28" />
                                            <circle cx="336" cy="384" r="28" fill="none"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="28" />
                                        </svg>
                                        <span class="widget__filter--btn__text">Filter</span>
                                    </button> --}}

                                    <div class="product__view--mode__list product__short--by align-items-center d-flex">
                                        <label class="product__view--label">Sort By :</label>
                                        <div class="select shop__header--select">
                                            <select id="sort_by" class="product__view--select">
                                                <option value="1" selected>Sort by latest</option>
                                                <option value="2">Sort by low to high price</option>
                                                <option value="3">Sort by high to low price</option>
                                                {{-- <option value="4">Sort by rating</option> --}}
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                @php
                                    // Check if any filter is applied
                                    $hasFilter =
                                        request()->filled('min_price') ||
                                        request()->filled('max_price') ||
                                        request()->filled('sort');
                                @endphp

                                @if ($hasFilter)
                                    {{-- Filter applied --}}
                                    <p class="product__showing--count">
                                        Showing {{ $carParts->firstItem() }}–{{ $carParts->lastItem() }} of
                                        {{ $carParts->total() }} filtered results
                                    </p>
                                @else
                                    {{-- No filter --}}
                                    <p class="product__showing--count">
                                        Showing {{ $carParts->firstItem() }}–{{ $carParts->lastItem() }} of
                                        {{ $carParts->total() }} total products
                                    </p>
                                @endif


                            </div>
                            <div class="tab_content">
                                {{-- Product grid view --}}
                                <div id="product_grid" class="tab_pane active show">
                                    <div class="product__section--inner">
                                        <div class="row mb--n30" id="car-parts-container">
                                            @include('front.partials.car_parts_list', [
                                                'carParts' => $carParts,
                                            ])
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End shop section -->

    <div id="offcanvas-overlay" class="offcanvas__overlay" aria-hidden="true"></div>

    <!-- OFFCANVAS SIDEBAR -->
    <aside id="offcanvas-filter" class="offcanvas__filter--sidebar" aria-hidden="true" role="dialog"
        aria-label="Filter sidebar">
        <button class="offcanvas__filter--close" aria-label="Close filter">&times;</button>

        <!-- ---------- BEGIN: copy your sidebar widgets (mobile version) ---------- -->
        <div class="offcanvas__inner">
            <!-- Price filter -->
            <div class="single__widget price__filter widget__bg">
                <h2 class="widget__title h3">Filter By Price</h2>
                <form id="price-filter-form">
                    <div class="price__filter--form__inner mb-15 d-flex align-items-center">
                        <div class="price__filter--group">
                            <label class="price__filter--label" for="Filter-Price-GTE">From</label>
                            <div class="price__filter--input d-flex align-items-center">
                                <span class="price__filter--currency">$</span>
                                <input class="price__filter--input__field border-0 custom_price_field" name="min_price"
                                    id="Filter-Price-GTE" type="number" placeholder="0" value="{{ $minPrice }}">
                            </div>
                        </div>

                        <div class="price__divider"><span>-</span></div>

                        <div class="price__filter--group">
                            <label class="price__filter--label" for="Filter-Price-LTE">To</label>
                            <div class="price__filter--input d-flex align-items-center">
                                <span class="price__filter--currency">$</span>
                                <input class="price__filter--input__field border-0 custom_price_field" name="max_price"
                                    id="Filter-Price-LTE" type="number" placeholder="250" value="{{ $maxPrice }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="primary__btn price__filter--btn">Filter</button>
                </form>
            </div>

            <!-- Categories -->
            <div class="single__widget widget__bg">
                <h2 class="widget__title h3">Categories</h2>
                <ul class="widget__categories--menu">
                    @foreach ($carPartTypes as $carPartType)
                        <li class="widget__categories--menu__list">
                            <a href="{{ route('type.view', $carPartType->slug) }}">
                                <label class="widget__categories--menu__label d-flex align-items-center">
                                    <img class="widget__categories--menu__img"
                                        src="{{ $carPartType->part_type_image ? asset('images/types/' . $carPartType->part_type_image) : asset('images/types/demo.png') }}"
                                        alt="categories-img">
                                    <span class="widget__categories--menu__text lh-base">{{ $carPartType->title }}</span>
                                </label>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- ---------- END: copy your sidebar widgets ---------- -->

    </aside>

    <!-- Start shipping section -->
    @include('front.partials.shipping_sec')
    <!-- End shipping section -->

    <script>
        (function() {
            // Utility to find the sidebar element the button targets (use data-target or default '#offcanvas-filter')
            function resolveTarget(el) {
                var targetSelector = el.getAttribute('data-target') || el.dataset.target || '#offcanvas-filter';
                return document.querySelector(targetSelector);
            }

            // Open / close functions
            var overlay = document.getElementById('offcanvas-overlay');
            var body = document.body;

            function openSidebar(side) {
                if (!side) {
                    console.warn('offcanvas: no sidebar element to open');
                    return;
                }
                side.classList.add('active');
                side.setAttribute('aria-hidden', 'false');
                if (overlay) overlay.classList.add('active'), overlay.setAttribute('aria-hidden', 'false');
                // lock body scroll (simple)
                body.style.overflow = 'hidden';
            }

            function closeSidebar(side) {
                if (!side) return;
                side.classList.remove('active');
                side.setAttribute('aria-hidden', 'true');
                if (overlay) overlay.classList.remove('active'), overlay.setAttribute('aria-hidden', 'true');
                body.style.overflow = '';
            }

            // Initialize open buttons
            var openBtns = document.querySelectorAll('.widget__filter--btn');
            if (!openBtns.length) {
                console.warn('offcanvas: no ".widget__filter--btn" buttons found on the page');
            }
            openBtns.forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var side = resolveTarget(btn);
                    if (!side) {
                        console.error('offcanvas: target sidebar not found for', btn);
                        return;
                    }
                    openSidebar(side);
                    // set aria-expanded on button
                    btn.setAttribute('aria-expanded', 'true');
                    // remember last opened button to reset its aria-expanded on close
                    side._lastButton = btn;
                });
            });

            // Close buttons inside sidebars
            document.addEventListener('click', function(e) {
                var closeBtn = e.target.closest('.offcanvas__filter--close');
                if (closeBtn) {
                    var side = closeBtn.closest('.offcanvas__filter--sidebar');
                    closeSidebar(side);
                    if (side && side._lastButton) side._lastButton.setAttribute('aria-expanded', 'false');
                }
            });

            // Overlay click closes all open sidebars
            if (overlay) {
                overlay.addEventListener('click', function() {
                    var side = document.querySelector('.offcanvas__filter--sidebar.active');
                    if (side) {
                        closeSidebar(side);
                        if (side._lastButton) side._lastButton.setAttribute('aria-expanded', 'false');
                    }
                });
            }

            // Escape key closes
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' || e.key === 'Esc') {
                    var side = document.querySelector('.offcanvas__filter--sidebar.active');
                    if (side) {
                        closeSidebar(side);
                        if (side._lastButton) side._lastButton.setAttribute('aria-expanded', 'false');
                    }
                }
            });

            // Optional: close when clicking a link inside the offcanvas (useful for category links)
            document.addEventListener('click', function(e) {
                var link = e.target.closest('.offcanvas__filter--sidebar a');
                if (link) {
                    var side = link.closest('.offcanvas__filter--sidebar');
                    // allow default link behavior but close sidebar afterwards
                    if (side) {
                        // small timeout to let navigation start if needed
                        setTimeout(function() {
                            closeSidebar(side);
                            if (side._lastButton) side._lastButton.setAttribute('aria-expanded',
                                'false');
                        }, 50);
                    }
                }
            });

        })();
    </script>

@endsection
