@extends('layouts.front.front-layout')

@section('content')
    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content text-center">
                        <ul class="breadcrumb__content--menu d-flex justify-content-center">
                            <li class="breadcrumb__content--menu__items"><a
                                    href="{{ route('customerDashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb__content--menu__items"><span>My Account</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->

    <!-- my account section start -->
    <section class="my__account--section section--padding">
        <div class="container">
            <p class="account__welcome--text">Hello, {{ Auth::user()->name }} welcome to your dashboard!</p>
            @if (session('success'))
                <div class="alert alert-success message_section" style="margin:20px;">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger main-danger message_section">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="my__account--section__inner border-radius-10 d-flex">
                <div class="account__left--sidebar">
                    <h2 class="account__content--title mb-20">My Profile</h2>
                    <ul class="account__menu">
                        <li class="account__menu--list active account_link" data-target="order_history"><a
                                href="#">Dashboard</a></li>
                        <li class="account__menu--list account_link" data-target="address"><a href="#">Addresses</a>
                        </li>
                        <li class="account__menu--list account_link" data-target="user_setting"><a
                                href="#">Setting</a></li>
                        {{-- <li class="account__menu--list account_link" data-target="section1"><a
                            href="wishlist.html">Wishlist</a></li> --}}
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <li class="account__menu--list"><button type="submit" class="logout_btn">Log Out</button></li>
                        </form>
                    </ul>
                </div>
                {{-- Dashboard order history --}}
                <div class="account__wrapper account_section" id="order_history">
                    <div class="account__content">
                        <h2 class="account__content--title h3 mb-20">Orders History</h2>
                        <div class="account__table--area">
                            <table class="account__table">
                                <thead class="account__table--header">
                                    <tr class="account__table--header__child">
                                        <th class="account__table--header__child--items">Order</th>
                                        <th class="account__table--header__child--items">Date</th>
                                        <th class="account__table--header__child--items">Payment Status</th>
                                        <th class="account__table--header__child--items">Fulfillment Status</th>
                                        <th class="account__table--header__child--items">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="account__table--body mobile__none">
                                    <tr class="account__table--body__child">
                                        <td class="account__table--body__child--items">#2014</td>
                                        <td class="account__table--body__child--items">November 24, 2022</td>
                                        <td class="account__table--body__child--items">Paid</td>
                                        <td class="account__table--body__child--items">Unfulfilled</td>
                                        <td class="account__table--body__child--items">$40.00 USD</td>
                                    </tr>
                                    <tr class="account__table--body__child">
                                        <td class="account__table--body__child--items">#2024</td>
                                        <td class="account__table--body__child--items">November 24, 2022</td>
                                        <td class="account__table--body__child--items">Paid</td>
                                        <td class="account__table--body__child--items">Fulfilled</td>
                                        <td class="account__table--body__child--items">$44.00 USD</td>
                                    </tr>
                                    <tr class="account__table--body__child">
                                        <td class="account__table--body__child--items">#2164</td>
                                        <td class="account__table--body__child--items">November 24, 2022</td>
                                        <td class="account__table--body__child--items">Paid</td>
                                        <td class="account__table--body__child--items">Unfulfilled</td>
                                        <td class="account__table--body__child--items">$36.00 USD</td>
                                    </tr>
                                    <tr class="account__table--body__child">
                                        <td class="account__table--body__child--items">#2345</td>
                                        <td class="account__table--body__child--items">November 24, 2022</td>
                                        <td class="account__table--body__child--items">Paid</td>
                                        <td class="account__table--body__child--items">Unfulfilled</td>
                                        <td class="account__table--body__child--items">$87.00 USD</td>
                                    </tr>
                                    <tr class="account__table--body__child">
                                        <td class="account__table--body__child--items">#1244</td>
                                        <td class="account__table--body__child--items">November 24, 2022</td>
                                        <td class="account__table--body__child--items">Paid</td>
                                        <td class="account__table--body__child--items">Fulfilled</td>
                                        <td class="account__table--body__child--items">$66.00 USD</td>
                                    </tr>
                                    <tr class="account__table--body__child">
                                        <td class="account__table--body__child--items">#3455</td>
                                        <td class="account__table--body__child--items">November 24, 2022</td>
                                        <td class="account__table--body__child--items">Paid</td>
                                        <td class="account__table--body__child--items">Fulfilled</td>
                                        <td class="account__table--body__child--items">$55.00 USD</td>
                                    </tr>
                                    <tr class="account__table--body__child">
                                        <td class="account__table--body__child--items">#4566</td>
                                        <td class="account__table--body__child--items">November 24, 2022</td>
                                        <td class="account__table--body__child--items">Paid</td>
                                        <td class="account__table--body__child--items">Unfulfilled</td>
                                        <td class="account__table--body__child--items">$87.00 USD</td>
                                    </tr>
                                </tbody>
                                <tbody class="account__table--body mobile__block">
                                    <tr class="account__table--body__child">
                                        <td class="account__table--body__child--items">
                                            <strong>Order</strong>
                                            <span>#2014</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Date</strong>
                                            <span>November 24, 2022</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Payment Status</strong>
                                            <span>Paid</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Fulfillment Status</strong>
                                            <span>Unfulfilled</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Total</strong>
                                            <span>$40.00 USD</span>
                                        </td>
                                    </tr>
                                    <tr class="account__table--body__child">
                                        <td class="account__table--body__child--items">
                                            <strong>Order</strong>
                                            <span>#2014</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Date</strong>
                                            <span>November 24, 2022</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Payment Status</strong>
                                            <span>Paid</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Fulfillment Status</strong>
                                            <span>Unfulfilled</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Total</strong>
                                            <span>$40.00 USD</span>
                                        </td>
                                    </tr>
                                    <tr class="account__table--body__child">
                                        <td class="account__table--body__child--items">
                                            <strong>Order</strong>
                                            <span>#2014</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Date</strong>
                                            <span>November 24, 2022</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Payment Status</strong>
                                            <span>Paid</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Fulfillment Status</strong>
                                            <span>Unfulfilled</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Total</strong>
                                            <span>$40.00 USD</span>
                                        </td>
                                    </tr>
                                    <tr class="account__table--body__child">
                                        <td class="account__table--body__child--items">
                                            <strong>Order</strong>
                                            <span>#2014</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Date</strong>
                                            <span>November 24, 2022</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Payment Status</strong>
                                            <span>Paid</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Fulfillment Status</strong>
                                            <span>Unfulfilled</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Total</strong>
                                            <span>$40.00 USD</span>
                                        </td>
                                    </tr>
                                    <tr class="account__table--body__child">
                                        <td class="account__table--body__child--items">
                                            <strong>Order</strong>
                                            <span>#2014</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Date</strong>
                                            <span>November 24, 2022</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Payment Status</strong>
                                            <span>Paid</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Fulfillment Status</strong>
                                            <span>Unfulfilled</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Total</strong>
                                            <span>$40.00 USD</span>
                                        </td>
                                    </tr>
                                    <tr class="account__table--body__child">
                                        <td class="account__table--body__child--items">
                                            <strong>Order</strong>
                                            <span>#2014</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Date</strong>
                                            <span>November 24, 2022</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Payment Status</strong>
                                            <span>Paid</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Fulfillment Status</strong>
                                            <span>Unfulfilled</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Total</strong>
                                            <span>$40.00 USD</span>
                                        </td>
                                    </tr>
                                    <tr class="account__table--body__child">
                                        <td class="account__table--body__child--items">
                                            <strong>Order</strong>
                                            <span>#2014</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Date</strong>
                                            <span>November 24, 2022</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Payment Status</strong>
                                            <span>Paid</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Fulfillment Status</strong>
                                            <span>Unfulfilled</span>
                                        </td>
                                        <td class="account__table--body__child--items">
                                            <strong>Total</strong>
                                            <span>$40.00 USD</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- End dashboard order history --}}

                {{-- Add address section --}}
                <div class="account__wrapper account_section" id="address">
                    <div class="account__content">
                        <form action="{{ route('address.store') }}" method="POST">
                            @csrf
                            <div class="login__section--inner">
                                <div class="row row-cols-md-2 row-cols-1">
                                    <div class="col">
                                        <div class="">
                                            <div class="account__login--header mb-25">
                                            </div>
                                            <div class="account__login--inner">
                                                <label>
                                                    <input class="account__login--input" placeholder="Address first line"
                                                        type="text" name="address_line_1"
                                                        value="{{ old('address_line_1') }}">
                                                </label>
                                                <label>
                                                    <input class="account__login--input" placeholder="Address second line"
                                                        type="text" name="address_line_2"
                                                        value="{{ old('address_line_2') }}">
                                                </label>
                                                <label>
                                                    <input class="account__login--input" placeholder="Enter city"
                                                        type="text" name="city" value="{{ old('city') }}">
                                                </label>

                                                <label>
                                                    <input class="account__login--input" placeholder="Enter state or province"
                                                        type="text" name="state" value="{{ old('state') }}">
                                                </label>

                                                <label>
                                                    <input class="account__login--input" placeholder="Enter postal code"
                                                        type="number" name="postal_code"
                                                        value="{{ old('postal_code') }}">
                                                </label>

                                                <label>
                                                    <input class="account__login--input" placeholder="Enter country"
                                                        type="text" name="country" value="{{ old('country') }}">
                                                </label>

                                                <!-- Types dropdown -->
                                                <div class="form-group">
                                                    <label for="addressType"></label>
                                                    <select class="form-control account__login--input" name="type"
                                                        id="addressType">
                                                        <option selected disabled>Choose one Type</option>
                                                        <option value="home"
                                                            {{ old('type') === 'home' ? 'selected' : '' }}>Home</option>
                                                        <option value="office"
                                                            {{ old('type') === 'office' ? 'selected' : '' }}>Office
                                                        </option>
                                                    </select>
                                                </div>

                                                <!-- Make default address -->
                                                <div class="form-check form-switch mb-3">
                                                    <input class="form-check-input" type="checkbox" id="defaultAddress"
                                                        name="is_default" value="1"
                                                        {{ old('is_default') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="defaultAddress">
                                                        Is this address default?
                                                    </label>
                                                </div>

                                                {{-- reCAPTCHA widget --}}
                                                {{-- {!! app('captcha')->display() !!}
                                            <noscript>Please enable Javascript</noscript> --}}
                                                <div class="d-flex justify-content-space-between align-items-center gap-2">
                                                    <button class="account__login--btn primary__btn" type="submit"
                                                        id="update_btn">Add Address</button>
                                                </div>
                                                </di>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
                {{-- End address section --}}

                {{-- User setting section --}}
                <div class="account__wrapper account_section" id="user_setting">
                    <div class="account__content">
                        <form action="{{ route('customer.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="login__section--inner">
                                <div class="row row-cols-md-2 row-cols-1">
                                    <div class="col">
                                        <div class="">
                                            <div class="account__login--header mb-25">
                                            </div>
                                            <div class="account__login--inner">
                                                <label>
                                                    <input class="account__login--input" placeholder="Enter username"
                                                        type="text" name="name" value="{{ Auth::user()->name }}"
                                                        readonly id="username">
                                                </label>
                                                <label>
                                                    <input class="account__login--input" placeholder="Enter password"
                                                        type="password" name="password">
                                                </label>
                                                <label>
                                                    <input class="account__login--input"
                                                        placeholder="Enter confirm Password" type="password"
                                                        name="password_confirmation">
                                                </label>

                                                {{-- reCAPTCHA widget --}}
                                                {{-- {!! app('captcha')->display() !!}
                                            <noscript>Please enable Javascript</noscript> --}}
                                                <div class="d-flex justify-content-space-between align-items-center gap-2">
                                                    <button class="account__login--btn primary__btn" type="button"
                                                        id="edit_btn">Edit</button>
                                                    <button class="account__login--btn primary__btn" type="submit"
                                                        id="update_btn">Update</button>
                                                </div>
                                                </di>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
                {{-- End user setting section --}}
            </div>
        </div>
    </section>
    <!-- my account section end -->

    @include('front.partials.shipping_sec')
@endsection
