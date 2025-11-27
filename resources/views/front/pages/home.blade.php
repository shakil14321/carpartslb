@extends('layouts.front.front-layout')

@section('content')
    <!-- Start slider section -->
    <section class="hero__slider--section slider__section--bg2 section--padding">
        <div class="container">
            <div class="row row-md-reverse">
                <div class="col-lg-12">
                    <div class="hero__slider--inner hero__slider--activation swiper">
                        <div class="hero__slider--wrapper swiper-wrapper">
                            <div class="swiper-slide ">
                                <div class="hero__slider--items__style2 home2-slider1-bg">
                                    <div class="slider__content style2">
                                        @php
                                            $setting = \App\Models\SiteSetting::first();
                                        @endphp
                                        <span
                                            class="slider__subtitle text__secondary">{{ $setting && $setting->slider1_subtitle ? $setting->slider1_subtitle : 'SHOP THE VERY BEST' }}</span>
                                        <h2 class="slider__maintitle--style2 h1">
                                            {{ $setting && $setting->slider1_maintitle ? $setting->slider1_maintitle : 'AUTO PARTS & ACCESSORIES' }}
                                        </h2>
                                        <p class="slider__desc text__secondary">
                                            {{ $setting && $setting->slider1_desc ? $setting->slider1_desc : 'High Quality - Extreme Performance' }}
                                        </p>
                                        <a class="primary__btn slider__btn" href="{{ route('shop') }}">
                                            Shop now
                                            <svg width="12" height="8" viewBox="0 0 12 8" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M11.8335 3.6178L8.26381 0.157332C8.21395 0.107774 8.1532 0.0681771 8.08544 0.0410843C8.01768 0.0139915 7.94441 0 7.87032 0C7.79624 0 7.72297 0.0139915 7.65521 0.0410843C7.58745 0.0681771 7.5267 0.107774 7.47684 0.157332C7.37199 0.262044 7.31393 0.39827 7.31393 0.539537C7.31393 0.680805 7.37199 0.817024 7.47684 0.921736L10.0943 3.45837H0.55625C0.405122 3.46829 0.26375 3.52959 0.160556 3.62994C0.057363 3.73029 0 3.86225 0 3.99929C0 4.13633 0.057363 4.26829 0.160556 4.36864C0.26375 4.46899 0.405122 4.53029 0.55625 4.54021H10.0927L7.47527 7.07826C7.37042 7.18298 7.31235 7.3192 7.31235 7.46047C7.31235 7.60174 7.37042 7.73796 7.47527 7.84267C7.52513 7.89223 7.58588 7.93182 7.65364 7.95892C7.7214 7.98601 7.79467 8 7.86875 8C7.94284 8 8.0161 7.98601 8.08386 7.95892C8.15162 7.93182 8.21238 7.89223 8.26223 7.84267L11.8335 4.38932C11.9406 4.28419 12 4.14649 12 4.00356C12 3.86063 11.9406 3.72293 11.8335 3.6178V3.6178Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="hero__slider--layer__style2">

                                        <img class="slider__layer--img "
                                            src="{{ $setting && $setting->carousel_image_one ? asset('public/images/banners/' . $setting->carousel_image_one) : asset('public/assets/front/img/slider/home-slider1-layer.png') }}"
                                            alt="slider-img">
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide ">
                                <div class="hero__slider--items__style2 home2-slider1-bg">
                                    <div class="slider__content style2">
                                        <span
                                            class="slider__subtitle text__secondary">{{ $setting && $setting->slider2_subtitle ? $setting->slider2_subtitle : 'SHOP THE VERY BEST' }}</span>
                                        <h2 class="slider__maintitle--style2 h1">
                                            {{ $setting && $setting->slider2_maintitle ? $setting->slider2_maintitle : 'AUTO PARTS & ACCESSORIES' }}
                                        </h2>
                                        <p class="slider__desc text__secondary">
                                            {{ $setting && $setting->slider2_desc ? $setting->slider2_desc : 'High Quality - Extreme Performance' }}
                                        </p>
                                        {{-- <span class="slider__subtitle text__secondary">SHOP THE VERY BEST</span>
                                        <h2 class="slider__maintitle--style2 h1">AUTO PARTS <br> & ACCESSORIES</h2>
                                        <p class="slider__desc text__secondary">High Quality - Extreme Performance</p> --}}
                                        <a class="primary__btn slider__btn" href="{{ route('shop') }}">
                                            Shop now
                                            <svg width="12" height="8" viewBox="0 0 12 8" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M11.8335 3.6178L8.26381 0.157332C8.21395 0.107774 8.1532 0.0681771 8.08544 0.0410843C8.01768 0.0139915 7.94441 0 7.87032 0C7.79624 0 7.72297 0.0139915 7.65521 0.0410843C7.58745 0.0681771 7.5267 0.107774 7.47684 0.157332C7.37199 0.262044 7.31393 0.39827 7.31393 0.539537C7.31393 0.680805 7.37199 0.817024 7.47684 0.921736L10.0943 3.45837H0.55625C0.405122 3.46829 0.26375 3.52959 0.160556 3.62994C0.057363 3.73029 0 3.86225 0 3.99929C0 4.13633 0.057363 4.26829 0.160556 4.36864C0.26375 4.46899 0.405122 4.53029 0.55625 4.54021H10.0927L7.47527 7.07826C7.37042 7.18298 7.31235 7.3192 7.31235 7.46047C7.31235 7.60174 7.37042 7.73796 7.47527 7.84267C7.52513 7.89223 7.58588 7.93182 7.65364 7.95892C7.7214 7.98601 7.79467 8 7.86875 8C7.94284 8 8.0161 7.98601 8.08386 7.95892C8.15162 7.93182 8.21238 7.89223 8.26223 7.84267L11.8335 4.38932C11.9406 4.28419 12 4.14649 12 4.00356C12 3.86063 11.9406 3.72293 11.8335 3.6178V3.6178Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="hero__slider--layer__style2">
                                        <img class="slider__layer--img "
                                            src="{{ $setting && $setting->carousel_image_two ? asset('public/images/banners/' . $setting->carousel_image_two) : asset('public/assets/front/img/slider/home-slider2-layer.png') }}"
                                            alt="slider-img">
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide ">
                                <div class="hero__slider--items__style2 home2-slider1-bg">
                                    <div class="slider__content style2">
                                        <span
                                            class="slider__subtitle text__secondary">{{ $setting && $setting->slider3_subtitle ? $setting->slider3_subtitle : 'SHOP THE VERY BEST' }}</span>
                                        <h2 class="slider__maintitle--style2 h1">
                                            {{ $setting && $setting->slider3_maintitle ? $setting->slider3_maintitle : 'AUTO PARTS & ACCESSORIES' }}
                                        </h2>
                                        <p class="slider__desc text__secondary">
                                            {{ $setting && $setting->slider3_desc ? $setting->slider3_desc : 'High Quality - Extreme Performance' }}
                                        </p>
                                        {{-- <span class="slider__subtitle text__secondary">SHOP THE VERY BEST</span>
                                        <h2 class="slider__maintitle--style2 h1">AUTO PARTS <br> & ACCESSORIES</h2>
                                        <p class="slider__desc text__secondary">High Quality - Extreme Performance</p> --}}
                                        <a class="primary__btn slider__btn" href="{{ route('shop') }}">
                                            Shop now
                                            <svg width="12" height="8" viewBox="0 0 12 8" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M11.8335 3.6178L8.26381 0.157332C8.21395 0.107774 8.1532 0.0681771 8.08544 0.0410843C8.01768 0.0139915 7.94441 0 7.87032 0C7.79624 0 7.72297 0.0139915 7.65521 0.0410843C7.58745 0.0681771 7.5267 0.107774 7.47684 0.157332C7.37199 0.262044 7.31393 0.39827 7.31393 0.539537C7.31393 0.680805 7.37199 0.817024 7.47684 0.921736L10.0943 3.45837H0.55625C0.405122 3.46829 0.26375 3.52959 0.160556 3.62994C0.057363 3.73029 0 3.86225 0 3.99929C0 4.13633 0.057363 4.26829 0.160556 4.36864C0.26375 4.46899 0.405122 4.53029 0.55625 4.54021H10.0927L7.47527 7.07826C7.37042 7.18298 7.31235 7.3192 7.31235 7.46047C7.31235 7.60174 7.37042 7.73796 7.47527 7.84267C7.52513 7.89223 7.58588 7.93182 7.65364 7.95892C7.7214 7.98601 7.79467 8 7.86875 8C7.94284 8 8.0161 7.98601 8.08386 7.95892C8.15162 7.93182 8.21238 7.89223 8.26223 7.84267L11.8335 4.38932C11.9406 4.28419 12 4.14649 12 4.00356C12 3.86063 11.9406 3.72293 11.8335 3.6178V3.6178Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="hero__slider--layer__style2">
                                        <img class="slider__layer--img "
                                            src="{{ $setting && $setting->carousel_image_three ? asset('public/images/banners/' . $setting->carousel_image_three) : asset('public/assets/front/img/slider/home-slider4-layer.png') }}"
                                            alt="slider-img">
                                    </div>
                                </div>
                            </div>
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
                        <div class="swiper-pagination"></div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- End slider section -->

    {{-- Brands section start --}}
    <section class="brands_section">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-10 col-md-4 text-center">
                    <div class="brand_heading text-center section__heading--maintitle">
                        <h2>Select By Brand</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @if ($carBrands->count() > 0)
                    @foreach ($carBrands as $carBrand)
                        <div class="col-12 col-sm-6 col-md-4 justify-content-center align-items-center">
                            <div class="brand_img_wrap card mb-4">
                                <a href="{{ route('brand.view', $carBrand->slug) }}"><img
                                        src="{{ $carBrand->brand_image ? asset('public/images/brands/' . $carBrand->brand_image) : asset('public/images/brands/demo.png') }}"
                                        alt="{{ $carBrand->title }}"></a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h3 class="product__card--title">Brands not found.</h3>
                @endif

            </div>
        </div>
    </section>
    {{-- End brands section --}}

    <!-- Start product section -->
    <section class="product__section section--padding  pt-0">
        <div class="container">
            <div class="section__heading border-bottom mb-30">
                <h2 class="section__heading--maintitle">Featured <span>Products</span></h2>
            </div>
            <div class="product__section--inner pb-15 product__swiper--activation swiper">
                <div class="swiper-wrapper">
                    @include('front.partials.car_part_list_slide', ['carParts' => $carParts])
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


    {{-- <!-- Start categories section -->
<section class="product__section section--padding  pt-0">
    <div class="container">
        <div class="section__heading section__heading--flex border-bottom d-flex justify-content-between mb-30">
            <h2 class="section__heading--maintitle">Shop By <span>Categories</span></h2>
            <ul class="nav tab__btn--wrapper" role="tablist">
                <li class="tab__btn--item" role="presentation">
                    <button class="tab__btn--link brand-tab-btn active" data-bs-toggle="tab"
                        data-bs-target="#basic_maintenance" type="button" role="tab" aria-selected="false">
                        Basic Maintenance</button>
                </li>
                <li class="tab__btn--item" role="presentation">
                    <button class="tab__btn--link brand-tab-btn" data-bs-toggle="tab" data-bs-target="#accessories"
                        type="button" role="tab" aria-selected="false">
                        Accessories </button>
                </li>
                <li class="tab__btn--item" role="presentation">
                    <button class="tab__btn--link brand-tab-btn" data-bs-toggle="tab" data-bs-target="#performance"
                        type="button" role="tab" aria-selected="false">
                        Performance</button>
                </li>
                <li class="tab__btn--item" role="presentation">
                    <button class="tab__btn--link brand-tab-btn" data-bs-toggle="tab" data-bs-target="#tools"
                        type="button" role="tab" aria-selected="false">
                        Tools</button>
                </li>
                <li class="tab__btn--item" role="presentation">
                    <button class="tab__btn--link brand-tab-btn " data-bs-toggle="tab" data-bs-target="#garage_gear"
                        type="button" role="tab" aria-selected="true"> Garage Gear
                    </button>
                </li>

                <li class="tab__btn--item" role="presentation">
                    <button class="tab__btn--link brand-tab-btn" data-bs-toggle="tab" data-bs-target="#car_care"
                        type="button" role="tab" aria-selected="true"> Car Care
                    </button>
                </li>

                <li class="tab__btn--item" role="presentation">
                    <button class="tab__btn--link brand-tab-btn " data-bs-toggle="tab" data-bs-target="#stuff"
                        type="button" role="tab" aria-selected="true"> Tees, Posters & Fun Stuff
                    </button>
                </li>

                <li class="tab__btn--item" role="presentation">
                    <button class="tab__btn--link brand-tab-btn" data-bs-toggle="tab" data-bs-target="#bookstore"
                        type="button" role="tab" aria-selected="true"> Pelican Bookstore
                    </button>
                </li>
            </ul>
        </div>
        <div class="product__section--inner">
            <div class="tab-content" id="nav-tabContent">
                <div id="basic_maintenance" class="tab-pane fade show active" role="tabpanel">
                    <div class="product__wrapper">
                        <div class="categories__section--inner">
                            <div class="row mb--n30">
                                @if ($partType10->count() > 0)
                                @foreach ($partType10 as $type10)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6 custom-col mb-30">
                                    <div class="categories__card style2">
                                        <a class="categories__card--link__style2 d-flex align-items-center"
                                            href="{{ route('type.view', $type10->slug) }}">
                                            <div class="categories__thumbnail">
                                                <img class="categories__thumbnail--img"
                                                    src="{{ asset('public/assets/front/img/categories/categories-product1.webp') }}"
                                                    alt="categories-img">
                                            </div>
                                            <div class="categories__content">
                                                <h2 class="categories__content--title">{{ $type10->title }}</h2>
                                                <span class="categories__content--subtitle">({{ $type10->car_part_count
                                                    }})</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <h3 class="product__card--title">No part types found</h3>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div id="accessories" class="tab-pane fade" role="tabpanel">
                    <div class="product__wrapper">
                        <div class="categories__section--inner">
                            <div class="row mb--n30">
                                @if ($partType20->count() > 0)
                                @foreach ($partType20 as $type20)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6 custom-col mb-30">
                                    <div class="categories__card style2">
                                        <a class="categories__card--link__style2 d-flex align-items-center"
                                            href="{{ route('type.view', $type20->slug) }}">
                                            <div class="categories__thumbnail">
                                                <img class="categories__thumbnail--img"
                                                    src="{{ asset('public/assets/front/img/categories/categories-product1.webp') }}"
                                                    alt="categories-img">
                                            </div>
                                            <div class="categories__content">
                                                <h2 class="categories__content--title">{{ $type20->title }}</h2>
                                                <span class="categories__content--subtitle">({{ $type20->car_part_count
                                                    }})</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <h3 class="product__card--title">No part types found</h3>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div id="performance" class="tab-pane fade" role="tabpanel">
                    <div class="product__wrapper">
                        <div class="categories__section--inner">
                            <div class="row mb--n30">
                                @if ($partType30->count() > 0)
                                @foreach ($partType30 as $type30)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6 custom-col mb-30">
                                    <div class="categories__card style2">
                                        <a class="categories__card--link__style2 d-flex align-items-center"
                                            href="{{ route('type.view', $type30->slug) }}">
                                            <div class="categories__thumbnail">
                                                <img class="categories__thumbnail--img"
                                                    src="{{ asset('public/assets/front/img/categories/categories-product1.webp') }}"
                                                    alt="categories-img">
                                            </div>
                                            <div class="categories__content">
                                                <h2 class="categories__content--title">{{ $type30->title }}</h2>
                                                <span class="categories__content--subtitle">({{ $type30->car_part_count
                                                    }})</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <h3 class="product__card--title">No part types found</h3>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tools" class="tab-pane fade" role="tabpanel">
                    <div class="categories__section--inner">
                        <div class="row mb--n30">
                            @if ($partType40->count() > 0)
                            @foreach ($partType40 as $type40)
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6 custom-col mb-30">
                                <div class="categories__card style2">
                                    <a class="categories__card--link__style2 d-flex align-items-center"
                                        href="{{ route('type.view', $type40->slug) }}">
                                        <div class="categories__thumbnail">
                                            <img class="categories__thumbnail--img"
                                                src="{{ asset('public/assets/front/img/categories/categories-product1.webp') }}"
                                                alt="categories-img">
                                        </div>
                                        <div class="categories__content">
                                            <h2 class="categories__content--title">{{ $type40->title }}</h2>
                                            <span class="categories__content--subtitle">({{ $type40->car_part_count
                                                }})</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <h3 class="product__card--title">No part types found</h3>
                            @endif
                        </div>
                    </div>
                </div>

                <div id="garage_gear" class="tab-pane fade" role="tabpanel">
                    <div class="categories__section--inner">
                        <div class="row mb--n30">
                            @if ($partType50->count() > 0)
                            @foreach ($partType50 as $type50)
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6 custom-col mb-30">
                                <div class="categories__card style2">
                                    <a class="categories__card--link__style2 d-flex align-items-center"
                                        href="{{ route('type.view', $type50->slug) }}">
                                        <div class="categories__thumbnail">
                                            <img class="categories__thumbnail--img"
                                                src="{{ asset('public/assets/front/img/categories/categories-product1.webp') }}"
                                                alt="categories-img">
                                        </div>
                                        <div class="categories__content">
                                            <h2 class="categories__content--title">{{ $type50->title }}</h2>
                                            <span class="categories__content--subtitle">({{ $type50->car_part_count
                                                }})</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <h3 class="product__card--title">No part types found</h3>
                            @endif
                        </div>
                    </div>
                </div>

                <div id="car_care" class="tab-pane fade" role="tabpanel">
                    <div class="product__wrapper">
                        <div class="categories__section--inner">
                            <div class="row mb--n30">
                                @if ($partType60->count() > 0)
                                @foreach ($partType60 as $type60)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6 custom-col mb-30">
                                    <div class="categories__card style2">
                                        <a class="categories__card--link__style2 d-flex align-items-center"
                                            href="{{ route('type.view', $type60->slug) }}">
                                            <div class="categories__thumbnail">
                                                <img class="categories__thumbnail--img"
                                                    src="{{ asset('public/assets/front/img/categories/categories-product1.webp') }}"
                                                    alt="categories-img">
                                            </div>
                                            <div class="categories__content">
                                                <h2 class="categories__content--title">{{ $type60->title }}</h2>
                                                <span class="categories__content--subtitle">({{ $type60->car_part_count
                                                    }})</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <h3 class="product__card--title">No part types found</h3>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div id="stuff" class="tab-pane fade" role="tabpanel">
                    <div class="product__wrapper">
                        <div class="categories__section--inner">
                            <div class="row mb--n30">
                                @if ($partType70->count() > 0)
                                @foreach ($partType70 as $type70)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6 custom-col mb-30">
                                    <div class="categories__card style2">
                                        <a class="categories__card--link__style2 d-flex align-items-center"
                                            href="{{ route('type.view', $type70->slug) }}">
                                            <div class="categories__thumbnail">
                                                <img class="categories__thumbnail--img"
                                                    src="{{ asset('public/assets/front/img/categories/categories-product1.webp') }}"
                                                    alt="categories-img">
                                            </div>
                                            <div class="categories__content">
                                                <h2 class="categories__content--title">{{ $type70->title }}</h2>
                                                <span class="categories__content--subtitle">({{ $type70->car_part_count
                                                    }})</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <h3 class="product__card--title">No part types found</h3>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div id="bookstore" class="tab-pane fade" role="tabpanel">
                    <div class="product__wrapper">
                        <div class="categories__section--inner">
                            <div class="row mb--n30">
                                @if ($partType80->count() > 0)
                                @foreach ($partType80 as $type80)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6 custom-col mb-30">
                                    <div class="categories__card style2">
                                        <a class="categories__card--link__style2 d-flex align-items-center"
                                            href="{{ route('type.view', $type80->slug) }}">
                                            <div class="categories__thumbnail">
                                                <img class="categories__thumbnail--img"
                                                    src="{{ asset('public/assets/front/img/categories/categories-product1.webp') }}"
                                                    alt="categories-img">
                                            </div>
                                            <div class="categories__content">
                                                <h2 class="categories__content--title">{{ $type80->title }}</h2>
                                                <span class="categories__content--subtitle">({{ $type80->car_part_count
                                                    }})</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <h3 class="product__card--title">No part types found</h3>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End categories section --> --}}

    {{-- Start choose confirmation section --}}
    <div class="confirmatio_part_sec">
        <div class="container">
            {{-- Section Heading --}}
            <div class="row mb-4">
                <div class="col-12">
                    <div class="section__heading border-bottom mb-30">
                        <h2 class="mb-2 section__heading--maintitle">Need Help <span>with Your Order?</span></h2>
                        <p>We’re available on <a href="http://wa.me/+96176380584"><strong>WhatsApp</strong></a> to assist
                            you with. Click here to direct to <a
                                href="http://wa.me/+96176380584"><strong>WhatsApp</strong></a> button anytime to chat
                            directly with our support team</p>
                    </div>
                </div>
            </div>

            {{-- Cards Section --}}
            <div class="row g-4">
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card h-100 text-center custom-card">
                        <div class="mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-calendar-check-icon lucide-calendar-check">
                                <path d="M8 2v4" />
                                <path d="M16 2v4" />
                                <rect width="18" height="18" x="3" y="4" rx="2" />
                                <path d="M3 10h18" />
                                <path d="m9 16 2 2 4-4" />
                            </svg>
                            </svg>
                        </div>
                        <h3 class="mb-2">Confirm Parts</h3>
                        <p class="mb-0">Reach us through <a
                                href="http://wa.me/+96176380584"><strong>WhatsApp</strong></a> to confirm if a specific
                            part will properly fit your car model before making
                            your purchase.</p>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card h-100 text-center custom-card">
                        <div class="mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-messages-square-icon lucide-messages-square">
                                <path
                                    d="M16 10a2 2 0 0 1-2 2H6.828a2 2 0 0 0-1.414.586l-2.202 2.202A.71.71 0 0 1 2 14.286V4a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z" />
                                <path
                                    d="M20 9a2 2 0 0 1 2 2v10.286a.71.71 0 0 1-1.212.502l-2.202-2.202A2 2 0 0 0 17.172 19H10a2 2 0 0 1-2-2v-1" />
                            </svg>
                        </div>
                        <h4 class="mb-2">Discussion On Specificaton</h4>
                        <p class="mb-0">Contact us directly for a detailed discussion regarding any part’s specifications
                            to
                            ensure accurate information before making your purchase decision.</p>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card h-100 text-center custom-card">
                        <div class="mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-package-search-icon lucide-package-search">
                                <path
                                    d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14" />
                                <path d="m7.5 4.27 9 5.15" />
                                <polyline points="3.29 7 12 12 20.71 7" />
                                <line x1="12" x2="12" y1="22" y2="12" />
                                <circle cx="18.5" cy="15.5" r="2.5" />
                                <path d="M20.27 17.27 22 19" />
                            </svg>
                        </div>
                        <h4 class="mb-2">Help To Find Parts</h4>
                        <p class="mb-0">We assist in locating any required parts. Contact us for professional guidance
                            and
                            support to help you find exactly what you need.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End choose confirmation section --}}


    <!-- Start shipping section -->
    @include('front.partials.shipping_sec')
    <!-- End shipping section -->
@endsection
