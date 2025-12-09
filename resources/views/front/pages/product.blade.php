@extends('layouts.front.front-layout')

@section('seo')
    <title>{{ $carPart->title ?? '' }}</title>
    <meta name="description" content="{{ $carPart->meta_description ?? '' }}">

    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph (for Facebook, WhatsApp etc.) -->
    <meta property="og:title" content="{{ $carPart->meta_title ?? $carPart->title }}">
    <meta property="og:description" content="{{ $carPart->meta_description ?? '' }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image"
        content="{{ $carPart->feature_image ? asset('public/images/parts/feature/' . $carPart->feature_image) : '' }}">

    <!-- Twitter Card (for Twitter share) -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $carPart->meta_title ?? $carPart->title }}">
    <meta name="twitter:description" content="{{ $carPart->meta_description ?? '' }}">
    <meta name="twitter:image"
        content="{{ $carPart->feature_image ? asset('public/images/parts/feature/' . $carPart->feature_image) : '' }}">
@endsection

@section('content')
    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content text-center">
                        <ul class="breadcrumb__content--menu d-flex justify-content-center">
                            <li class="breadcrumb__content--menu__items"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb__content--menu__items"><span>Product</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 main-danger notic_bar" role="alert"
            style="margin:20px; border-radius:8px;">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Whoops! Something went wrong:</strong>
            <ul class="mt-2 mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif



    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 notic_bar" role="alert"
            style="margin:20px; border-radius:8px;">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Start product details section -->
    <section class="product__details--section section--padding">
        <div class="container">
            <div class="row row-cols-lg-2 row-cols-md-2">
                <div class="col">
                    <div class="product__details--media">
                        <div class="single__product--preview swiper mb-25">
                            <div class="swiper-wrapper">

                                {{-- Feature image first --}}
                                @if ($carPart->feature_image)
                                    <div class="swiper-slide">
                                        <div class="product__media--preview__items">
                                            <a class="product__media--preview__items--link glightbox"
                                                data-gallery="product-media-preview"
                                                href="{{ asset('public/images/parts/feature/' . $carPart->feature_image) }}">
                                                <img class="product__media--preview__items--img product-feature-img"
                                                    src="{{ asset('public/images/parts/feature/' . $carPart->feature_image) }}"
                                                    alt="product-feature-img">
                                            </a>
                                            <div class="product__media--view__icon">
                                                <a class="product__media--view__icon--link glightbox"
                                                    href="{{ asset('public/images/parts/feature/' . $carPart->feature_image) }}"
                                                    data-gallery="product-media-zoom">
                                                    <svg class="product__items--action__btn--svg"
                                                        xmlns="http://www.w3.org/2000/svg" width="22.51" height="22.443"
                                                        viewBox="0 0 512 512">
                                                        <path
                                                            d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z"
                                                            fill="none" stroke="currentColor" stroke-miterlimit="10"
                                                            stroke-width="32"></path>
                                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                            stroke-miterlimit="10" stroke-width="32"
                                                            d="M338.29 338.29L448 448">
                                                        </path>
                                                    </svg>
                                                    <span class="visually-hidden">product view</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Gallery images --}}
                                @foreach ($carPart->gallery_images as $img)
                                    <div class="swiper-slide">
                                        <div class="product__media--preview__items">
                                            <a class="product__media--preview__items--link glightbox"
                                                data-gallery="product-media-preview"
                                                href="{{ asset('public/images/parts/gallery/' . $img) }}">
                                                <img class="product__media--preview__items--img"
                                                    src="{{ asset('public/images/parts/gallery/' . $img) }}"
                                                    alt="product-gallery-img">
                                            </a>
                                            <div class="product__media--view__icon">
                                                <a class="product__media--view__icon--link glightbox"
                                                    href="{{ asset('public/images/parts/gallery/' . $img) }}"
                                                    data-gallery="product-media-zoom">
                                                    <svg class="product__items--action__btn--svg"
                                                        xmlns="http://www.w3.org/2000/svg" width="22.51" height="22.443"
                                                        viewBox="0 0 512 512">
                                                        <path
                                                            d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z"
                                                            fill="none" stroke="currentColor" stroke-miterlimit="10"
                                                            stroke-width="32"></path>
                                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                            stroke-miterlimit="10" stroke-width="32"
                                                            d="M338.29 338.29L448 448">
                                                        </path>
                                                    </svg>
                                                    <span class="visually-hidden">product view</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        {{-- Thumbnails --}}
                        <div class="single__product--nav swiper">
                            <div class="swiper-wrapper">
                                @if ($carPart->feature_image)
                                    <div class="swiper-slide">
                                        <div class="product__media--nav__items">
                                            <img class="product__media--nav__items--img"
                                                src="{{ asset('public/images/parts/feature/' . $carPart->feature_image) }}"
                                                alt="product-nav-img">
                                        </div>
                                    </div>
                                @endif
                                @foreach ($carPart->gallery_images as $img)
                                    <div class="swiper-slide">
                                        <div class="product__media--nav__items">
                                            <img class="product__media--nav__items--img"
                                                src="{{ asset('public/images/parts/gallery/' . $img) }}"
                                                alt="product-nav-img">
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="swiper__nav--btn swiper-button-next">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </div>
                            <div class="swiper__nav--btn swiper-button-prev">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="15 18 9 12 15 6"></polyline>
                                </svg>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col">
                    <div class="product__details--info">
                        <form action="#">
                            <h2 class="product__details--info__title mb-15">{{ ucwords($carPart->title ?? '') }}</h2>
                            {{-- <p>{{ $carPart->carPartBrand->title }}</p>
                        <div>
                            <img src="#" alt="" />
                        </div> --}}
                            <div class="product__details--info__price mb-12">
                                <span
                                    class="current__price">{{ $carPart->sale_price ? '$' . $carPart->sale_price : '' }}</span>
                                <span
                                    class="old__price">{{ $carPart->original_price ? '$' . $carPart->original_price : '' }}</span>
                            </div>
                            <ul class="rating product__card--rating mb-15 d-flex">
                                @for ($i = 1; $i <= 5; $i++)
                                    <li class="rating__list">
                                        <span class="rating__icon">
                                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z"
                                                    fill="{{ $i <= $averageRating ? '#ed1d24' : '#a7a8a3' }}" />
                                            </svg>
                                        </span>
                                    </li>
                                @endfor

                                <li>
                                    @if ($productReviews->count() > 0)
                                        <span
                                            class="rating__review--text">{{ $productReviews->count() . ' Reviews' }}</span>
                                    @else
                                        <span class="rating__review--text">0 Review</span>
                                    @endif
                                </li>
                            </ul>
                            <p class="product__details--info__desc mb-15">{!! $carPart->short_description ?? '' !!}</p>
                            <div class="product__variant">
                                <div class="product__variant--list quantity d-flex align-items-center mb-20">
                                    <!-- Quantity selector -->
                                    <div class="quantity-selector d-flex align-items-center me-2 gap-2">
                                        <button type="button" class="quantity-btn decrement btn minus-btn">-</button>
                                        <input type="number" class="quantity-input border-radius-5 text-center"
                                            value="1" min="1" style="width:50px;">
                                        <button type="button" class="quantity-btn increment btn plus-btn">+</button>
                                    </div>

                                    <!-- Add To Cart button -->
                                    <button class="product__card--btn primary__btn add-to-cart-btn"
                                        data-id="{{ $carPart->id }}" data-name="{{ $carPart->title }}"
                                        data-price="{{ $carPart->price }}"
                                        data-sale_price="{{ $carPart->sale_price ?? '' }}"
                                        data-original_price="{{ $carPart->original_price ?? '' }}"
                                        data-slug="{{ $carPart->slug ?? '' }}" data-sku="{{ $carPart->sku ?? '' }}"
                                        data-part_number="{{ $carPart->part_number ?? '' }}"
                                        data-image="{{ $carPart->feature_image ?? 'demo.png' }}" type="button">
                                        <svg width="14" height="11" viewBox="0 0 14 11" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.2371 4H11.5261L8.5027 0.460938C8.29176 0.226562 7.9402 0.203125 7.70582 0.390625C7.47145 0.601562 7.44801 0.953125 7.63551 1.1875L10.0496 4H3.46364L5.8777 1.1875C6.0652 0.953125 6.04176 0.601562 5.80739 0.390625C5.57301 0.203125 5.22145 0.226562 5.01051 0.460938L1.98707 4H0.299574C0.135511 4 0.0183239 4.14062 0.0183239 4.28125V4.84375C0.0183239 5.00781 0.135511 5.125 0.299574 5.125H0.721449L1.3777 9.78906C1.44801 10.3516 1.91676 10.75 2.47926 10.75H11.0339C11.5964 10.75 12.0652 10.3516 12.1355 9.78906L12.7918 5.125H13.2371C13.3777 5.125 13.5183 5.00781 13.5183 4.84375V4.28125C13.5183 4.14062 13.3777 4 13.2371 4ZM11.0339 9.625H2.47926L1.86989 5.125H11.6433L11.0339 9.625ZM7.33082 6.4375C7.33082 6.13281 7.07301 5.875 6.76832 5.875C6.4402 5.875 6.20582 6.13281 6.20582 6.4375V8.3125C6.20582 8.64062 6.4402 8.875 6.76832 8.875C7.07301 8.875 7.33082 8.64062 7.33082 8.3125V6.4375Z"
                                                fill="currentColor" />
                                        </svg>
                                        Add To Cart
                                    </button>
                                </div>

                                {{-- <div class="product__variant--list mb-15">
                                <a class="variant__wishlist--icon mb-15" href="wishlist.html" title="Add to wishlist">
                                    <svg class="quickview__variant--wishlist__svg" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512">
                                        <path
                                            d="M352.92 80C288 80 256 144 256 144s-32-64-96.92-64c-52.76 0-94.54 44.14-95.08 96.81-1.1 109.33 86.73 187.08 183 252.42a16 16 0 0018 0c96.26-65.34 184.09-143.09 183-252.42-.54-52.67-42.32-96.81-95.08-96.81z"
                                            fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="32" />
                                    </svg>
                                    Add to Wishlist
                                </a>
                                <button class="variant__buy--now__btn primary__btn" type="submit">Buy it now</button>
                            </div> --}}
                                <div class="product__variant--list mb-15">
                                    <div class="product__details--info__meta">
                                        <p class="product__details--info__meta--list"><strong>SKU:</strong> <span>
                                                {{ ucwords($carPart->sku) ?? '' }}</span> </p>
                                        <p class="product__details--info__meta--list"><strong>Stock:</strong>
                                            <span>{{ $carPart->stock_type === 'in' ? 'In Stock' : 'Out of Stock' }}</span>
                                        </p>
                                        <p class="product__details--info__meta--list"><strong>Category:</strong>
                                            <span>{{ $carPart->carPartType->title ?? 'None' }}</span>
                                        </p>

                                        <p class="product__details--info__meta--list"><strong>Part#:</strong>
                                            <span>{{ ucwords($carPart->part_number ?? '') }}</span>
                                        </p>

                                        {{-- <p class="product__details--info__meta--list"><strong>Stock Available:</strong>
                                        <span>{{ $carPart->stock_quantity ?? '' }}</span>
                                    </p> --}}
                                        <div class="part_brnad_image_sec">
                                            <img src="{{ asset('public/images/brands/' . ($carPart->carPartBrand->brand_image ?? 'demo.png')) }}"
                                                alt="{{ $carPart->carPartBrand->title ?? 'Brand Image' }}"
                                                style="width:120px; height:60px; border-radius:10px;" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="quickview__social d-flex align-items-center mb-15">
                                <label class="quickview__social--title">Share:</label>
                                <ul class="quickview__social--wrapper mt-0 d-flex gap-2">

                                    <!-- Facebook Share -->
                                    <li>
                                        <a target="_blank"
                                            href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}">
                                            Facebook
                                        </a>
                                    </li>

                                    <!-- WhatsApp Share -->
                                    <li>
                                        <a target="_blank"
                                            href="https://api.whatsapp.com/send?text={{ urlencode($carPart->title . ' ' . request()->fullUrl()) }}">
                                            WhatsApp
                                        </a>
                                    </li>

                                    <!-- Twitter (X) Share -->
                                    <li>
                                        <a target="_blank"
                                            href="https://twitter.com/intent/tweet?text={{ urlencode($carPart->title) }}&url={{ urlencode(request()->fullUrl()) }}">
                                            Twitter
                                        </a>
                                    </li>

                                    <!-- LinkedIn Share -->
                                    <li>
                                        <a target="_blank"
                                            href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}">
                                            LinkedIn
                                        </a>
                                    </li>

                                </ul>
                            </div> --}}

                            <div class="quickview__social d-flex align-items-center mb-15">
                                <label class="quickview__social--title">Social Share:</label>
                                <ul class="quickview__social--wrapper mt-0 d-flex">
                                    <li class="quickview__social--list">
                                        <a class="quickview__social--icon" target="_blank"
                                            href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="7.667" height="16.524"
                                                viewBox="0 0 7.667 16.524">
                                                <path data-name="Path 237"
                                                    d="M967.495,353.678h-2.3v8.253h-3.437v-8.253H960.13V350.77h1.624v-1.888a4.087,4.087,0,0,1,.264-1.492,2.9,2.9,0,0,1,1.039-1.379,3.626,3.626,0,0,1,2.153-.6l2.549.019v2.833h-1.851a.732.732,0,0,0-.472.151.8.8,0,0,0-.246.642v1.719H967.8Z"
                                                    transform="translate(-960.13 -345.407)" fill="currentColor" />
                                            </svg>
                                            <span class="visually-hidden">Facebook</span>
                                        </a>
                                    </li>
                                    <li class="quickview__social--list">
                                        <a class="quickview__social--icon" href="javascript:void(0)"
                                            onclick="copyLink()">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="17.497" height="17.492"
                                                viewBox="0 0 19.497 19.492">
                                                <path data-name="Icon awesome-instagram"
                                                    d="M9.747,6.24a5,5,0,1,0,5,5A4.99,4.99,0,0,0,9.747,6.24Zm0,8.247A3.249,3.249,0,1,1,13,11.238a3.255,3.255,0,0,1-3.249,3.249Zm6.368-8.451A1.166,1.166,0,1,1,14.949,4.87,1.163,1.163,0,0,1,16.115,6.036Zm3.31,1.183A5.769,5.769,0,0,0,17.85,3.135,5.807,5.807,0,0,0,13.766,1.56c-1.609-.091-6.433-.091-8.042,0A5.8,5.8,0,0,0,1.64,3.13,5.788,5.788,0,0,0,.065,7.215c-.091,1.609-.091,6.433,0,8.042A5.769,5.769,0,0,0,1.64,19.341a5.814,5.814,0,0,0,4.084,1.575c1.609.091,6.433.091,8.042,0a5.769,5.769,0,0,0,4.084-1.575,5.807,5.807,0,0,0,1.575-4.084c.091-1.609.091-6.429,0-8.038Zm-2.079,9.765a3.289,3.289,0,0,1-1.853,1.853c-1.283.509-4.328.391-5.746.391S5.28,19.341,4,18.837a3.289,3.289,0,0,1-1.853-1.853c-.509-1.283-.391-4.328-.391-5.746s-.113-4.467.391-5.746A3.289,3.289,0,0,1,4,3.639c1.283-.509,4.328-.391,5.746-.391s4.467-.113,5.746.391a3.289,3.289,0,0,1,1.853,1.853c.509,1.283.391,4.328.391,5.746S17.855,15.705,17.346,16.984Z"
                                                    transform="translate(0.004 -1.492)" fill="currentColor"></path>
                                            </svg>
                                            <span class="visually-hidden">Instagram</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            {{-- <div class="guarantee__safe--checkout">
                            <h5 class="guarantee__safe--checkout__title">Guaranteed Safe Checkout</h5>
                            <img class="guarantee__safe--checkout__img"
                                src="{{ asset('public/assets/front/img/other/safe-checkout.webp') }}" alt="Payment Image">
                        </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End product details section -->

    <!-- Start product details tab section -->
    <section class="product__details--tab__section section--padding">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <ul class="product__tab--one product__details--tab d-flex mb-30">
                        <li class="product__details--tab__list active" data-toggle="tab" data-target="#description">
                            Description</li>
                        <li class="product__details--tab__list" data-toggle="tab" data-target="#reviews">Product Reviews
                        </li>
                        {{-- <li class="product__details--tab__list" data-toggle="tab" data-target="#information">Additional
                        Info
                    </li> --}}
                    </ul>
                    <div class="product__details--tab__inner border-radius-10">
                        <div class="tab_content">
                            <div id="description" class="tab_pane active show">
                                <div class="product__tab--content">
                                    <div class="product__tab--content__step mb-30">
                                        <p class="product__tab--content__desc">{!! $carPart->description ?? '' !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div id="reviews" class="tab_pane">
                                <div class="product__reviews">
                                    <div class="product__reviews--header">
                                        <h2 class="product__reviews--header__title h3 mb-20">Customer Reviews</h2>
                                        <div class="reviews__ratting d-flex align-items-center">
                                            <ul class="rating d-flex">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <li class="rating__list">
                                                        <span class="rating__icon">
                                                            <svg width="14" height="13" viewBox="0 0 14 13"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z"
                                                                    fill="{{ $i <= $averageRating ? '#ed1d24' : '#a7a8a3' }}" />
                                                            </svg>
                                                        </span>
                                                    </li>
                                                @endfor
                                            </ul>
                                            <span class="reviews__summary--caption">Based on
                                                {{ $productReviews->count() ?? '' }} reviews</span>
                                        </div>
                                        @if (auth()->check())
                                            <!-- User is logged in -->
                                            <a class="actions__newreviews--btn primary__btn" href="#writereview">Write A
                                                Review</a>
                                        @else
                                            <!-- User is NOT logged in, redirect to login -->
                                            <a class="actions__newreviews--btn primary__btn"
                                                href="{{ route('login') }}">Write A Review</a>
                                        @endif
                                        {{-- <a class="actions__newreviews--btn primary__btn" href="#writereview">Write A
                                        Review</a> --}}
                                    </div>
                                    @if ($productReviews->count() > 0)
                                        @foreach ($productReviews as $productReview)
                                            <div class="reviews__comment--area">
                                                <div class="reviews__comment--list d-flex">
                                                    <div class="reviews__comment--content">
                                                        <div class="reviews__comment--top d-flex justify-content-between">
                                                            <div class="reviews__comment--top__left">
                                                                <h3 class="reviews__comment--content__title h4">
                                                                    {{ ucwords($productReview->username ?? '') }}</h3>
                                                                <ul class="rating d-flex">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        <li class="rating__list">
                                                                            <span class="rating__icon">
                                                                                <svg width="14" height="13"
                                                                                    viewBox="0 0 14 13" fill="none"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z"
                                                                                        fill="{{ $i <= $productReview->rating ? '#ed1d24' : 'currentColor' }}" />
                                                                                </svg>
                                                                            </span>
                                                                        </li>
                                                                    @endfor
                                                                </ul>
                                                            </div>
                                                            <span
                                                                class="reviews__comment--content__date">{{ $productReview->updated_at->format('M d, Y') ?? '' }}</span>
                                                        </div>
                                                        <p class="reviews__comment--content__desc">
                                                            {{ $productReview->review ?? '' }}</p>
                                                    </div>
                                                </div>
                                                @if ($productReview->reply)
                                                    <div class="reviews__comment--list margin__left d-flex">

                                                        <div class="reviews__comment--content">
                                                            <div
                                                                class="reviews__comment--top d-flex justify-content-between">
                                                                <div class="reviews__comment--top__left">
                                                                    <h3 class="reviews__comment--content__title h4">
                                                                        {{ $productReview->reply_admin_name ?? '' }}</h3>
                                                                </div>
                                                            </div>
                                                            <p class="reviews__comment--content__desc">
                                                                {{ $productReview->reply ?? '' }}</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        <h3 class="text-danger">There is no review.</h3>
                                    @endif

                                    @if (Auth::check())
                                        <div id="writereview" class="reviews__comment--reply__area">
                                            <form action="{{ route('review.store') }}" method="POST">
                                                @csrf
                                                <h3 class="reviews__comment--reply__title mb-15">Add a review </h3>
                                                <div class="reviews__ratting mb-20">
                                                    <ul class="rating d-flex">
                                                        <li class="rating__list rating_item" data-value="1">
                                                            <span class="rating__icon">
                                                                <svg width="14" height="13" viewBox="0 0 14 13"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z"
                                                                        fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                        </li>
                                                        <li class="rating__list rating_item" data-value="2">
                                                            <span class="rating__icon">
                                                                <svg width="14" height="13" viewBox="0 0 14 13"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z"
                                                                        fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                        </li>
                                                        <li class="rating__list rating_item" data-value="3">
                                                            <span class="rating__icon">
                                                                <svg width="14" height="13" viewBox="0 0 14 13"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z"
                                                                        fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                        </li>
                                                        <li class="rating__list rating_item" data-value="4">
                                                            <span class="rating__icon">
                                                                <svg width="14" height="13" viewBox="0 0 14 13"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z"
                                                                        fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                        </li>
                                                        <li class="rating__list rating_item" data-value="5">
                                                            <span class="rating__icon">
                                                                <svg width="14" height="13" viewBox="0 0 14 13"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M6.08398 0.921875L4.56055 4.03906L1.11523 4.53125C0.505859 4.625 0.271484 5.375 0.716797 5.82031L3.17773 8.23438L2.5918 11.6328C2.49805 12.2422 3.1543 12.7109 3.69336 12.4297L6.76367 10.8125L9.81055 12.4297C10.3496 12.7109 11.0059 12.2422 10.9121 11.6328L10.3262 8.23438L12.7871 5.82031C13.2324 5.375 12.998 4.625 12.3887 4.53125L8.9668 4.03906L7.41992 0.921875C7.16211 0.382812 6.36523 0.359375 6.08398 0.921875Z"
                                                                        fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="row">
                                                    <input type="hidden" name="product_id"
                                                        value="{{ $carPart->id ?? '' }}">
                                                    <input type="hidden" name="product_title"
                                                        value="{{ $carPart->title ?? '' }}">
                                                    <input type="hidden" name="product_url"
                                                        value="{{ url()->current() }}">
                                                    <input type="hidden" name="user_image"
                                                        value="{{ Auth::user()->user_image }}">
                                                    <input type="hidden" name="rating" id="rating" value="0">

                                                    <div class="col-12 mb-10">
                                                        <textarea class="reviews__comment--reply__textarea" placeholder="Your Comments...." name="review">{{ old('review') }}</textarea>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 mb-15">
                                                        <label>
                                                            <input class="reviews__comment--reply__input"
                                                                placeholder="Your Name...." type="text"
                                                                value="{{ Auth::user()->name ?? '' }}" readonly>
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 mb-15">
                                                        <label>
                                                            <input class="reviews__comment--reply__input"
                                                                placeholder="Your Email...." type="email"
                                                                value="{{ Auth::user()->email ?? '' }}" readonly>
                                                        </label>
                                                    </div>
                                                </div>
                                                <button class="primary__btn text-white" data-hover="Submit"
                                                    type="submit">SUBMIT</button>
                                            </form>
                                        </div>
                                    @else
                                        <h3 class="text-danger fw-bold">To share your valuable review, please log in <a
                                                href="{{ route('login.form') }}" class="text-decoration-underline">log
                                                in</a> first.</h3>
                                    @endif
                                </div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        const stars = document.querySelectorAll(".rating_item");
                                        const ratingInput = document.getElementById("rating");

                                        stars.forEach((star, index) => {
                                            star.addEventListener("click", function() {
                                                // Pehle sab se active class hatao
                                                stars.forEach(s => s.classList.remove("active"));

                                                // Clicked star tak sabko active karo
                                                for (let i = 0; i <= index; i++) {
                                                    stars[i].classList.add("active");
                                                }

                                                // Hidden input mei rating value save karo
                                                const ratingValue = star.getAttribute("data-value");
                                                ratingInput.value = ratingValue;
                                            });
                                        });
                                    });
                                </script>
                                <style>
                                    .rating__list.active svg {
                                        color: #ffcc00;
                                        /* gold color */
                                        fill: #ffcc00;
                                    }

                                    .rating__list svg {
                                        color: #ccc;
                                        /* default grey */
                                        cursor: pointer;
                                        transition: color 0.2s ease;
                                    }
                                </style>

                            </div>
                            {{-- <div id="information" class="tab_pane">
                            <div class="product__tab--conten">
                                <div class="product__tab--content__step">
                                    <ul class="additional__info_list">
                                        <li class="additional__info_list--item">
                                            <span class="info__list--item-head"><strong>Color</strong></span>
                                            <span class="info__list--item-content">Black, white, blue, red, gray</span>
                                        </li>
                                        <li class="additional__info_list--item">
                                            <span class="info__list--item-head"><strong>Weight</strong></span>
                                            <span class="info__list--item-content">2kg</span>
                                        </li>
                                        <li class="additional__info_list--item">
                                            <span class="info__list--item-head"><strong>Brand</strong></span>
                                            <span class="info__list--item-content">Gadget</span>
                                        </li>
                                        <li class="additional__info_list--item">
                                            <span class="info__list--item-head"><strong>Guarantee</strong></span>
                                            <span class="info__list--item-content">5 years</span>
                                        </li>
                                        <li class="additional__info_list--item">
                                            <span class="info__list--item-head"><strong>Battery</strong></span>
                                            <span class="info__list--item-content">10000 mA</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End product details tab section -->

    <!-- Start related product section -->
    <section class="product__section section--padding ">
        <div class="container">
            <div class="section__heading border-bottom mb-30">
                <h2 class="section__heading--maintitle">Related <span>Products</span></h2>
            </div>
            <div class="product__section--inner pb-15 product__swiper--activation swiper">
                <div class="swiper-wrapper">
                    @if ($relatedProducts->count() > 0)
                        @foreach ($relatedProducts as $related)
                            <div class="swiper-slide swiper-slide-product">
                                <article class="product__card">
                                    <div class="product__card--thumbnail">
                                        <a class="product__card--thumbnail__link display-block"
                                            href="{{ route('product.view', $related->slug) }}">
                                            @if ($related->feature_image)
                                                <img class="product__card--thumbnail__img product__primary--img"
                                                    src="{{ asset('public/images/parts/feature/' . ($related->feature_image ?? 'demo.png')) }}"
                                                    alt="feature_img">
                                            @endif

                                            @if ($related->gallery_images)
                                                <img class="product__card--thumbnail__img product__secondary--img"
                                                    src="{{ asset('public/images/parts/feature/' . ($related->feature_image ?? 'demo.png')) }}"
                                                    alt="feature_img">
                                            @endif

                                        </a>
                                        @php
                                            $original_price = $carPart->original_price;
                                            $sale_price = $carPart->sale_price;

                                            if ($original_price > 0 && $sale_price > 0) {
                                                $percent_discount = round(
                                                    (($original_price - $sale_price) / $original_price) * 100,
                                                );
                                            } else {
                                                $percent_discount = null;
                                            }
                                        @endphp

                                        @if ($percent_discount)
                                            <span class="product__badge">-{{ $percent_discount }}%</span>
                                        @endif

                                    </div>
                                    <div class="product__card--content">
                                        <h3 class="product__card--title"><a
                                                href="{{ route('product.view', $related->slug) }}">{{ $related->title ?? '' }}</a>
                                        </h3>

                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <p class="oth_brand_title"><span class="oth_p">Brand:</span> <span
                                                        class="rating__review--text">{{ ucwords($related->carBrand->title ?? '') }}</span>
                                                </p>

                                                {{-- <p class="oth_p_m"><span class="oth_p">Type:</span> <span class="rating__review--text">{{
                                            ucwords($carPart->carPartType->title ?? '' ) }}</span></p> --}}
                                                <p class="oth_p_part"><span class="oth_p">Part#:</span> <span
                                                        class="rating__review--text">{{ ucwords($related->part_number ?? '') }}</span>
                                                </p>
                                            </div>
                                            <div class="part_brnad_image_sec">
                                                <img src="{{ asset('public/images/brands/' . ($related->carPartBrand->brand_image ?? 'demo.png')) }}"
                                                    alt="{{ $related->carPartBrand->title ?? 'Brand Image' }}"
                                                    style="width:120px; height:60px; border:1px solid #a7a8a3; border-radius:10px;" />
                                            </div>
                                        </div>

                                        <div class="product__card--price">
                                            <span
                                                class="current__price">{{ $related->sale_price ? '$' . $related->sale_price : '' }}</span>
                                            <span class="old__price">
                                                {{ $related->original_price ? '$' . $related->original_price : '' }}</span>
                                        </div>
                                        <div class="product__card--footer">
                                            <a class="product__card--btn primary__btn"
                                                href="{{ route('product.view', $related->slug) }}">
                                                <svg width="14" height="11" viewBox="0 0 14 11" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M13.2371 4H11.5261L8.5027 0.460938C8.29176 0.226562 7.9402 0.203125 7.70582 0.390625C7.47145 0.601562 7.44801 0.953125 7.63551 1.1875L10.0496 4H3.46364L5.8777 1.1875C6.0652 0.953125 6.04176 0.601562 5.80739 0.390625C5.57301 0.203125 5.22145 0.226562 5.01051 0.460938L1.98707 4H0.299574C0.135511 4 0.0183239 4.14062 0.0183239 4.28125V4.84375C0.0183239 5.00781 0.135511 5.125 0.299574 5.125H0.721449L1.3777 9.78906C1.44801 10.3516 1.91676 10.75 2.47926 10.75H11.0339C11.5964 10.75 12.0652 10.3516 12.1355 9.78906L12.7918 5.125H13.2371C13.3777 5.125 13.5183 5.00781 13.5183 4.84375V4.28125C13.5183 4.14062 13.3777 4 13.2371 4ZM11.0339 9.625H2.47926L1.86989 5.125H11.6433L11.0339 9.625ZM7.33082 6.4375C7.33082 6.13281 7.07301 5.875 6.76832 5.875C6.4402 5.875 6.20582 6.13281 6.20582 6.4375V8.3125C6.20582 8.64062 6.4402 8.875 6.76832 8.875C7.07301 8.875 7.33082 8.64062 7.33082 8.3125V6.4375ZM9.95582 6.4375C9.95582 6.13281 9.69801 5.875 9.39332 5.875C9.0652 5.875 8.83082 6.13281 8.83082 6.4375V8.3125C8.83082 8.64062 9.0652 8.875 9.39332 8.875C9.69801 8.875 9.95582 8.64062 9.95582 8.3125V6.4375ZM4.70582 6.4375C4.70582 6.13281 4.44801 5.875 4.14332 5.875C3.8152 5.875 3.58082 6.13281 3.58082 6.4375V8.3125C3.58082 8.64062 3.8152 8.875 4.14332 8.875C4.44801 8.875 4.70582 8.64062 4.70582 8.3125V6.4375Z"
                                                        fill="currentColor" />
                                                </svg>
                                                Buy Now
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    @else
                        <h3 class="product__card--title">No related products found</h3>
                    @endif
                </div>
                <div class="swiper__nav--btn swiper-button-next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class=" -chevron-right">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
                <div class="swiper__nav--btn swiper-button-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class=" -chevron-left">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </div>
            </div>
        </div>
    </section>
    <!-- End product section -->

    <!-- Start shipping section -->
    @include('front.partials.shipping_sec')

    <!-- End shipping section -->
    <script>
        function copyLink() {
            navigator.clipboard.writeText("{{ request()->fullUrl() }}")
                .then(() => {
                    alert("Product link copied! You can paste it in Instagram.");
                });
        }
    </script>


    <script>
        document.querySelectorAll('.quantity-selector').forEach(selector => {
            const input = selector.querySelector('.quantity-input');
            const increment = selector.querySelector('.increment');
            const decrement = selector.querySelector('.decrement');

            // Find the closest product container
            const productDetails = selector.closest('.product__variant').parentElement;
            const currentPriceElem = productDetails.querySelector('.current__price');
            const oldPriceElem = productDetails.querySelector('.old__price');

            // Store base prices
            const baseSalePrice = parseFloat(currentPriceElem.textContent.replace('$', '')) || 0;
            const baseOriginalPrice = oldPriceElem ? parseFloat(oldPriceElem.textContent.replace('$', '')) || 0 : 0;

            function updatePrice() {
                const qty = parseInt(input.value) || 1;
                currentPriceElem.textContent = '$' + (baseSalePrice * qty).toFixed(2);
                if (oldPriceElem && baseOriginalPrice > 0) {
                    oldPriceElem.textContent = '$' + (baseOriginalPrice * qty).toFixed(2);
                }
            }

            increment.addEventListener('click', () => {
                input.value = parseInt(input.value) + 1;
                updatePrice();
            });

            decrement.addEventListener('click', () => {
                if (parseInt(input.value) > 1) {
                    input.value = parseInt(input.value) - 1;
                    updatePrice();
                }
            });

            input.addEventListener('input', () => {
                if (parseInt(input.value) < 1 || isNaN(input.value)) input.value = 1;
                updatePrice();
            });
        }); // Pass quantity to Add To
        document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const quantity = this.closest('.product__variant--list').querySelector('.quantity-input')
                    .value;
                console.log('Quantity for this product:', quantity);
                // Include quantity in your AJAX call here
            });
        });
    </script>

    <script>
        // document.querySelectorAll('.quantity-selector').forEach(selector => {
        //     const input = selector.querySelector('.quantity-input');
        //     const increment = selector.querySelector('.increment');
        //     const decrement = selector.querySelector('.decrement');

        //     increment.addEventListener('click', () => {
        //         input.value = parseInt(input.value) + 1;
        //     });

        //     decrement.addEventListener('click', () => {
        //         if (parseInt(input.value) > 1) {
        //             input.value = parseInt(input.value) - 1;
        //         }
        //     });
        // });

        // // Optional: include quantity in Add To Cart button data
        // document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
        //     btn.addEventListener('click', function() {
        //         const quantity = this.closest('.product__variant--list').querySelector('.quantity-input')
        //             .value;
        //         console.log('Add to cart quantity:', quantity);
        //         // Pass quantity along with other product data to your AJAX or form
        //     });
        // });
    </script>
@endsection
