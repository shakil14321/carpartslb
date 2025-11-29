@extends('layouts.front.front-layout')

@section('content')
    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content text-center">
                        <ul class="breadcrumb__content--menu d-flex justify-content-center">
                            <li class="breadcrumb__content--menu__items"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb__content--menu__items"><span>Checkout</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 main-danger notic_bar text-center"
            role="alert" style="margin:20px; border-radius:8px;">
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
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 notic_bar text-center" role="alert"
            style="margin:20px; border-radius:8px;">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <!-- Start checkout page area -->
    <div class="checkout__page--area section--padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6">
                    <div class="main checkout__mian">
                        <div class="checkout__content--step section__contact--information">
                            <div
                                class="section__header checkout__section--header d-flex align-items-center justify-content-between mb-25">
                                <h2 class="section__header--title h3">Account</h2>
                                <p class="layout__flex--item">
                                    Already have an account?
                                    <a class="layout__flex--item__link"
                                        href="{{ Auth::check() && Auth::user()->role === 'customer' ? route('customerDashboard') : route('login.form') }}">{{ Auth::check() && Auth::user()->role === 'customer' ? ucwords(Auth::user()->name) : 'Login' }}</a>
                                </p>
                            </div>

                        </div>
                        <div class="checkout__content--step section__shipping--address">
                            <div class="section__header mb-25">
                                <h2 class="section__header--title h3">Billing Details</h2>
                            </div>
                            {{-- New addresss section --}}
                            <details id="new_address_form_sec">
                                <summary class="checkout__checkbox mb-20">
                                    <input class="checkout__checkbox--input checkbox" type="checkbox" id="new_checkbox">
                                    <span class="checkout__checkbox--checkmark checkmark"></span>
                                    <span class="checkout__checkbox--label add_label" id="newAdd">Ship order to new
                                        address?</span>
                                </summary>
                                <div class="section__shipping--address__content">
                                    <div class="row">
                                        <form action="{{ route('order.store') }}" method="post" id="new_address_form">
                                            @csrf

                                            @foreach ($cartItems as $id => $product)
                                                <input type="hidden" name="products[{{ $id }}][title]"
                                                    value="{{ $product['title'] }}">
                                                @if ($product['sale_price'])
                                                    <input type="hidden" name="products[{{ $id }}][sale_price]"
                                                        value="{{ $product['sale_price'] ?? '' }}">
                                                @else
                                                    <input type="hidden"
                                                        name="products[{{ $id }}][original_price]"
                                                        value="{{ $product['original_price'] ?? '' }}">
                                                @endif
                                                <input type="hidden" name="products[{{ $id }}][stock_quantity]"
                                                    value="{{ $product['quantity'] ?? 0 }}">
                                                <input type="hidden" name="products[{{ $id }}][slug]"
                                                    value="{{ $product['slug'] ?? '' }}">
                                                <input type="hidden" name="products[{{ $id }}][sku]"
                                                    value="{{ $product['sku'] ?? '' }}">
                                                <input type="hidden" name="products[{{ $id }}][part_number]"
                                                    value="{{ $product['part_number'] ?? '' }}">
                                            @endforeach

                                            {{-- product summary subtotal, total, taxes hidden input fields --}}
                                            <input type="hidden" name="total" id="totalAmountHiddenInput" value="">
                                            <input type="hidden" name="payment_method" value="cod"
                                                id="paymentMethodHiddenInput"> {{-- COD, CARD etc. --}}
                                            <input type="hidden" name="status">
                                            <input type="hidden" name="order_number">
                                            <input type="hidden" name="order_address_default" value="no">
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                            <div class="row">
                                                {{-- first name --}}
                                                <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                                    <div class="checkout__input--list ">
                                                        <label class="checkout__input--label mb-5" for="input7">Fist
                                                            Name
                                                            <span class="checkout__input--label__star">*</span></label>
                                                        <input class="checkout__input--field border-radius-5"
                                                            placeholder="First name (optional)" id="firstName"
                                                            type="text" value="{{ old('first_name') }}"
                                                            name="first_name">
                                                    </div>
                                                </div>

                                                {{-- last name --}}
                                                <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                                    <div class="checkout__input--list">
                                                        <label class="checkout__input--label mb-5" for="input8">Last
                                                            Name
                                                            <span class="checkout__input--label__star">*</span></label>
                                                        <input class="checkout__input--field border-radius-5"
                                                            placeholder="Last name" id="lastName" type="text"
                                                            value="{{ old('last_name') }}" name="last_name">
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Address line 1 --}}
                                            <div class="col-12 mb-20">
                                                <div class="checkout__input--list">
                                                    <label class="checkout__input--label mb-5" for="input10">Address
                                                        <span class="checkout__input--label__star">*</span></label>
                                                    <input class="checkout__input--field border-radius-5"
                                                        placeholder="House number, Street name" id="addLineOne"
                                                        type="text" value="{{ old('address_line_1') }}"
                                                        name="address_line_1">
                                                </div>
                                            </div>

                                            {{-- Address line 2 --}}
                                            <div class="col-12 mb-20">
                                                <div class="checkout__input--list">
                                                    <input class="checkout__input--field border-radius-5"
                                                        placeholder="Apartment, suite, etc. (optional)" type="text"
                                                        value="{{ old('address_line_2') }}" name="address_line_2"
                                                        id="addLineTwo">
                                                </div>
                                            </div>

                                            <div class="row">
                                                {{-- town or city --}}
                                                <div class="col-lg-6 mb-20">
                                                    <div class="checkout__input--list">
                                                        <label class="checkout__input--label mb-5"
                                                            for="input11">Town/City
                                                            <span class="checkout__input--label__star">*</span></label>
                                                        <input class="checkout__input--field border-radius-5"
                                                            placeholder="City" id="addCity" type="text"
                                                            value="{{ old('city') }}" name="city">
                                                    </div>
                                                </div>

                                                {{-- province or state --}}
                                                <div class="col-lg-6 mb-20">
                                                    <div class="checkout__input--list">
                                                        <label class="checkout__input--label mb-5"
                                                            for="input11">State/Province
                                                            <span class="checkout__input--label__star">*</span></label>
                                                        <input class="checkout__input--field border-radius-5"
                                                            placeholder="State Or Province" id="addState" type="text"
                                                            value="{{ old('state') }}" name="state">
                                                    </div>
                                                </div>

                                                {{-- country --}}
                                                <div class="col-lg-6 mb-20">
                                                    <div class="checkout__input--list">
                                                        <label class="checkout__input--label mb-5"
                                                            for="country2">Country/region
                                                            <span class="checkout__input--label__star">*</span></label>
                                                        <div class="checkout__input--select select">
                                                            <select class="checkout__input--select__field border-radius-5"
                                                                id="addCountry" name="country">
                                                                {{-- <option value="{{ old('country') }}">
                                                                    {{ old('country') }}</option> --}}
                                                                <option value="lebanon">Lebanon</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- postal code --}}
                                                <div class="col-lg-6 mb-20">
                                                    <div class="checkout__input--list">
                                                        <label class="checkout__input--label mb-5" for="input12">Postal
                                                            Code
                                                            <span class="checkout__input--label__star">*</span></label>
                                                        <input class="checkout__input--field border-radius-5"
                                                            placeholder="Postal code" id="postalCode" type="text"
                                                            value="{{ old('postal_code') }}" name="postal_code">
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- order notes --}}
                                            <div class="order-notes mb-20">
                                                <label class="checkout__input--label mb-5" for="order">Order Notes
                                                    <span class="checkout__input--label__star">*</span></label>
                                                <textarea class="checkout__notes--textarea__field border-radius-5" id="orderNotes"
                                                    placeholder="Notes about your order, e.g. special notes for delivery." spellcheck="false" name="order_notes"></textarea>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </details>
                            {{-- End new addresss section --}}

                            {{-- Start default address.If user has default address --}}
                            @if ($user && $defaultAddress)
                                <details id="default_address_form_sec">
                                    <summary class="checkout__checkbox mb-20">
                                        <input class="checkout__checkbox--input checkbox" type="checkbox"
                                            id="default_checkbox">
                                        <span class="checkout__checkbox--checkmark checkmark"></span>
                                        <span class="checkout__checkbox--label add_label" id="defaulAdd">Ship to a
                                            default
                                            address?</span>
                                    </summary>
                                    <div class="section__shipping--address__content">
                                        <div class="row">
                                            <form action="{{ route('order.default') }}" method="post"
                                                id="defaul_address_form">
                                                @csrf

                                                @foreach ($cartItems as $id => $product)
                                                    <input type="hidden" name="products[{{ $id }}][title]"
                                                        value="{{ $product['title'] }}">
                                                    @if ($product['sale_price'])
                                                        <input type="hidden"
                                                            name="products[{{ $id }}][sale_price]"
                                                            value="{{ $product['sale_price'] ?? '' }}">
                                                    @else
                                                        <input type="hidden"
                                                            name="products[{{ $id }}][original_price]"
                                                            value="{{ $product['original_price'] ?? '' }}">
                                                    @endif
                                                    <input type="hidden"
                                                        name="products[{{ $id }}][stock_quantity]"
                                                        value="{{ $product['quantity'] ?? 0 }}">
                                                    <input type="hidden" name="products[{{ $id }}][slug]"
                                                        value="{{ $product['slug'] ?? '' }}">
                                                    <input type="hidden"
                                                        name="products[{{ $id }}][part_number]"
                                                        value="{{ $product['part_number'] ?? '' }}">
                                                @endforeach

                                                {{-- product summary subtotal, total, taxes hidden input fields --}}
                                                <input type="hidden" name="total" id="defaultTotalAmountHiddenInput"
                                                    value="">
                                                <input type="hidden" name="payment_method" value="cod"
                                                    id="paymentMethodHiddenInput"> {{-- COD, CARD etc. --}}
                                                <input type="hidden" name="status">
                                                <input type="hidden" name="order_number">
                                                <input type="hidden" name="order_address_default" value="yes">
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                                <div class="row">
                                                    {{-- First name --}}
                                                    <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                                        <div class="checkout__input--list ">
                                                            <label class="checkout__input--label mb-5" for="input7">Fist
                                                                Name
                                                                <span class="checkout__input--label__star">*</span></label>
                                                            <input class="checkout__input--field border-radius-5"
                                                                placeholder="First name (optional)" id="input7"
                                                                type="text" name="first_name"
                                                                value="{{ old('first_name', $defaultAddress->user->first_name) }}"
                                                                readonly>
                                                        </div>
                                                    </div>

                                                    {{-- last name --}}
                                                    <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                                        <div class="checkout__input--list">
                                                            <label class="checkout__input--label mb-5" for="input8">Last
                                                                Name
                                                                <span class="checkout__input--label__star">*</span></label>
                                                            <input class="checkout__input--field border-radius-5"
                                                                placeholder="Last name" id="input8" type="text"
                                                                name="last_name"
                                                                value="{{ old('last_name', $defaultAddress->user->last_name) }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Address line 1 --}}
                                                <div class="col-12 mb-20">
                                                    <div class="checkout__input--list">
                                                        <label class="checkout__input--label mb-5" for="input10">Address
                                                            <span class="checkout__input--label__star">*</span></label>
                                                        <input class="checkout__input--field border-radius-5"
                                                            placeholder="House number, Street name" id="input10"
                                                            type="text" name="address_line_1"
                                                            value="{{ old('address_line_1', $defaultAddress->address_line_1) }}"
                                                            readonly>
                                                    </div>
                                                </div>

                                                {{-- Address line 2 --}}
                                                <div class="col-12 mb-20">
                                                    <div class="checkout__input--list">
                                                        <input class="checkout__input--field border-radius-5"
                                                            placeholder="Apartment, suite, etc. (optional)" type="text"
                                                            name="address_line_2"
                                                            value="{{ old('address_line_2', $defaultAddress->address_line_2) }}"
                                                            readonly>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    {{-- city or town --}}
                                                    <div class="col-lg-6 mb-20">
                                                        <div class="checkout__input--list">
                                                            <label class="checkout__input--label mb-5"
                                                                for="input11">Town/City
                                                                <span class="checkout__input--label__star">*</span></label>
                                                            <input class="checkout__input--field border-radius-5"
                                                                placeholder="City" id="input11" type="text"
                                                                name="city"
                                                                value="{{ old('city', $defaultAddress->city) }}" readonly>
                                                        </div>
                                                    </div>

                                                    {{-- state or province --}}
                                                    <div class="col-lg-6 mb-20">
                                                        <div class="checkout__input--list">
                                                            <label class="checkout__input--label mb-5"
                                                                for="input11">State/Province
                                                                <span class="checkout__input--label__star">*</span></label>
                                                            <input class="checkout__input--field border-radius-5"
                                                                placeholder="City" id="input11" type="text"
                                                                name="state"
                                                                value="{{ old('state', $defaultAddress->state) }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    {{-- country --}}
                                                    <div class="col-lg-6 mb-20">
                                                        <div class="checkout__input--list">
                                                            <label class="checkout__input--label mb-5"
                                                                for="country2">Country/region
                                                                <span class="checkout__input--label__star">*</span></label>
                                                            <div class="checkout__input--select select">
                                                                <select
                                                                    class="checkout__input--select__field border-radius-5"
                                                                    id="country2" name="country" readonly>
                                                                    <option
                                                                        value="{{ old('country', $defaultAddress->country) }}"
                                                                        selected>
                                                                        {{ old('country', $defaultAddress->country) }}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- postal code --}}
                                                    <div class="col-lg-6 mb-20">
                                                        <div class="checkout__input--list">
                                                            <label class="checkout__input--label mb-5"
                                                                for="input12">Postal
                                                                Code
                                                                <span class="checkout__input--label__star">*</span></label>
                                                            <input class="checkout__input--field border-radius-5"
                                                                placeholder="Postal code" id="input12" type="text"
                                                                value="{{ old('postal_code', $defaultAddress->postal_code) }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Order notes --}}
                                                <div class="order-notes mb-20">
                                                    <label class="checkout__input--label mb-5" for="order">Order
                                                        Notes <span class="checkout__input--label__star">*</span></label>
                                                    <textarea class="checkout__notes--textarea__field border-radius-5" name="order_notes" id="order"
                                                        placeholder="Notes about your order, e.g. special notes for delivery." spellcheck="false"></textarea>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </details>
                            @else
                                <p class="text-danger">No default address found. Please add a default address in your
                                    account. If you want to ship order to default address.</p>
                            @endif
                            {{-- End default address --}}

                        </div>

                        <div class="checkout__content--step__footer d-flex align-items-center">
                            <a class="continue__shipping--btn primary__btn border-radius-5 text-capitalize"
                                href="{{ route('shop') }}">Go to shop page</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <aside class="checkout__sidebar sidebar border-radius-10">
                        <h2 class="checkout__order--summary__title text-center mb-15">Your Order Summary</h2>
                        <div class="cart__table checkout__product--table">
                            <table class="cart__table--inner">
                                <tbody class="cart__table--body">
                                    @forelse($cartItems as $id => $item)
                                        <tr class="cart__table--body__items">
                                            <td class="cart__table--body__list">
                                                <div class="product__image two d-flex align-items-center">
                                                    <div class="product__thumbnail border-radius-5">
                                                        <a class="display-block" href="{{ route('product.view', $id) }}">
                                                            <img class="display-block border-radius-5"
                                                                src="{{ $item->product->feature_image ? asset('public/images/parts/feature/' . $item->product->feature_image) : asset('public/assets/front/img/product/default.webp') }}"
                                                                alt="cart-product">
                                                        </a>
                                                        <span
                                                            class="product__thumbnail--quantity">{{ $item['quantity'] ?? '' }}</span>
                                                    </div>
                                                    <div class="product__description">
                                                        <h4 class="product__description--name">
                                                            <a
                                                                href="{{ route('product.view', $id) }}">{{ $item['title'] ?? '' }}</a>
                                                        </h4>
                                                        <p><small>{{ $item['sku'] ?? '' }}</small></p>
                                                        @if (!empty($item['variant']))
                                                            <span
                                                                class="product__description--variant">{{ $item['variant'] ?? '' }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__table--body__list">
                                                <span
                                                    class="cart__price">${{ number_format((isset($item['sale_price']) ? $item['sale_price'] : $item['original_price']) * ($item['quantity'] ?? 1), 2) }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center">Your cart is empty.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{-- Coupon section --}}
                        {{-- <div class="checkout__discount--code">
                            <form class="d-flex" action="#">
                                <label>
                                    <input class="checkout__discount--code__input--field border-radius-5"
                                        placeholder="Gift card or discount code" type="text">
                                </label>
                                <button class="checkout__discount--code__btn primary__btn border-radius-5"
                                    type="submit">Apply</button>
                            </form>
                        </div> --}}
                        <div class="checkout__total">
                            <table class="checkout__total--table">
                                <tbody class="checkout__total--body">
                                    <tr class="checkout__total--items">
                                        <td class="checkout__total--title text-left">Subtotal </td>
                                        <td class="checkout__total--amount text-right">${{ number_format($total, 2) }}
                                        </td>
                                    </tr>
                                    {{-- Shipping tax row --}}
                                    {{-- <tr class="checkout__total--items">
                                        <td class="checkout__total--title text-left">Shipping</td>
                                        <td class="checkout__total--calculated__text text-right">Calculated at next step
                                        </td>
                                    </tr> --}}
                                </tbody>
                                <tfoot class="checkout__total--footer">
                                    <tr class="checkout__total--footer__items">
                                        <td class="checkout__total--footer__title checkout__total--footer__list text-left">
                                            Total </td>
                                        <td class="checkout__total--footer__amount checkout__total--footer__list text-right"
                                            id="totalAmount">
                                            ${{ number_format($total, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment__history mb-30">
                            <h3 class="payment__history--title mb-20">Payment Method</h3>
                            {{-- Payment --}}
                            <div class="col-lg-12 mb-20">
                                <div class="checkout__input--list">
                                    <div class="checkout__input--select select">
                                        <select class="checkout__input--select__field border-radius-5" id="orderType">
                                            {{-- <option value="{{ old('order_type') }}">
                                                                    {{ old('order_type') }}</option> --}}
                                            <option value="usa">Cash On Delivery</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="checkout__now--btn primary__btn" type="submit" id="checkout_payment">Checkout
                            Now</button>
                    </aside>
                </div>

            </div>
        </div>
    </div>
    <!-- End checkout page area -->

    <!-- Start shipping section -->
    @include('front.partials.shipping_sec')
    <!-- End shipping section -->
@endsection
