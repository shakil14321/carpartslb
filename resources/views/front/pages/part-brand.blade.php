@extends('layouts.front.front-layout')

@section('seo')
    <title>{{ $title ?? 'Home - Carpartsld' }}</title>
    <meta name="description" content="{{ $meta_des ?? 'Best auto parts store' }}">
    <meta name="keywords" content="'auto parts, accessories, shop'">

    <!-- OG tags -->
    <meta property="og:title" content="{{ $title ?? 'Home - Your Website' }}">
    <meta property="og:description" content="{{ $meta_des ?? 'Best auto parts store' }}">
    <meta property="og:image" content="{{ asset('public/assets/front/img/logo/seo_image.png') }}">
    <meta property="og:image:type" content="image/png" />
    <meta property="og:url" content="{{ url()->current() }}">

    {{-- @php
        // Build the schema inside a PHP block so Blade doesn't try to parse @context etc.
$schema = [
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
        [
            '@type' => 'ListItem',
            'position' => 1,
            'name' => 'Home',
            'item' => url('/'),
        ],
        [
            '@type' => 'ListItem',
            'position' => 2,
            'name' => 'Car Parts',
            'item' => url()->current(),
                ],
            ],
        ];
    @endphp

    <script type="application/ld+json">
    {!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
    </script> --}}
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
                            <li class="breadcrumb__content--menu__items"><span>By Part Brand</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->

    {{--  --}}

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
                                                            ? asset('public/images/types/' . $carPartType->part_type_image)
                                                            : asset('public/images/types/demo.png') }}"
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
                                        <div class="small__product--card d-flex">
                                            <div class="small__product--thumbnail">
                                                @if ($carPartFav->feature_image)
                                                    <img class="product__card--thumbnail__img product__primary--img"
                                                        src="{{ asset('images/parts/feature/' . $carPartFav->feature_image) }}"
                                                        alt="feature_img">
                                                @else
                                                    <img class="product__card--thumbnail__img product__primary--img"
                                                        src="{{ asset('images/brands/demo.png') }}" alt="no-image">
                                                @endif

                                                <a class="display-block"
                                                    href="{{ route('product.details', $carPartFav->slug) }}">
                                                    <img src="" alt="product-img">
                                                </a>
                                            </div>
                                            <div class="small__product--content">
                                                <h3 class="small__product--card__title">
                                                    <a href="{{ route('product.details', $carPartFav->slug) }}">
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
                                    <button class="widget__filter--btn d-flex d-lg-none align-items-center" data-offcanvas>
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
                                <p class="product__showing--count">
                                    Showing {{ $carParts->firstItem() }}–{{ $carParts->lastItem() }} of
                                    {{ $carParts->total() }} results
                                </p>

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

    <!-- Start shipping section -->
    @include('front.partials.shipping_sec')
    <!-- End shipping section -->
@endsection
