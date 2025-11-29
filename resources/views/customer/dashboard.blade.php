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
                                        <th class="account__table--header__child--items">Sr #</th>
                                        <th class="account__table--header__child--items">Order #</th>
                                        <th class="account__table--header__child--items">Customer Name</th>
                                        <th class="account__table--header__child--items">Date & Time</th>
                                        <th class="account__table--header__child--items">Payment</th>
                                        <th class="account__table--header__child--items">Status</th>
                                        <th class="account__table--header__child--items">Total</th>
                                        <th class="account__table--header__child--items">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="account__table--body mobile__none">
                                    @if ($orders->count() > 0)
                                        @foreach ($orders as $order)
                                            <tr class="account__table--body__child">
                                                <td class="account__table--body__child--items">{{ $loop->iteration }}</td>
                                                <td class="account__table--body__child--items"><a
                                                        href="{{ route('orderView.customer', ['id' => $order->id]) }}">{{ $order->order_number ?? '' }}</a>
                                                </td>
                                                <td class="account__table--body__child--items">
                                                    {{ ucwords(trim(($order->first_name ?? '') . ' ' . ($order->last_name ?? ''))) }}
                                                </td>
                                                <td class="account__table--body__child--items">
                                                    {{ $order->updated_at ?? '' }}</td>
                                                <td class="account__table--body__child--items">
                                                    {{ strtoupper($order->payment_method) ?? '' }}</td>
                                                <td class="account__table--body__child--items">
                                                    {{ ucwords($order->status) ?? '' }}
                                                </td>
                                                <td class="account__table--body__child--items">
                                                    {{ $order->total ? $order->total : '' }}
                                                </td>
                                                <td class="account__table--body__child--items">
                                                    <a href="{{ route('orderView.customer', ['id' => $order->id]) }}"
                                                        class="btn btn-sm btn-info">
                                                        View
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="account__table--body__child">
                                            <td colspan="7" class="account__table--body__child--items text-center">Orders
                                                not found.</td>
                                        </tr>
                                    @endif

                                </tbody>
                                <tbody class="account__table--body mobile__block">
                                    @if ($orders->count() > 0)
                                        @foreach ($orders as $order)
                                            <tr class="account__table--body__child">
                                                <td class="account__table--body__child--items">
                                                    <strong>Order #</strong>
                                                    <span>{{ $loop->iteration }}</span>
                                                </td>
                                                <td class="account__table--body__child--items">
                                                    <strong>Customer Name</strong>
                                                    <span>{{ trim(($order->first_name ?? '') . ' ' . ($order->last_name ?? '')) }}</span>
                                                </td>
                                                <td class="account__table--body__child--items">
                                                    <strong>Date</strong>
                                                    <span>{{ $order->updated_at ?? '' }}</span>
                                                </td>
                                                <td class="account__table--body__child--items">
                                                    <strong>Order Type</strong>
                                                    <span>{{ $order->type ?? '' }}</span>
                                                </td>
                                                <td class="account__table--body__child--items">
                                                    <strong>Order Process</strong>
                                                    <span>{{ $order->status ?? '' }}</span>
                                                </td>
                                                <td class="account__table--body__child--items">
                                                    <strong>Total</strong>
                                                    <span>{{ $order->total ? '$' . $order->total : '' }}</span>
                                                </td>
                                                <td class="account__table--body__child--items">
                                                    <a href="{{ route('orderView.customer', ['id' => $order->id]) }}"
                                                        class="btn btn-sm btn-info">
                                                        View
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="account__table--body__child">
                                            <td colspan="6" class="account__table--body__child--items text-center">Orders
                                                not found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- End dashboard order history --}}

                {{-- Address section --}}
                <div class="account__wrapper account_section" id="address">
                    <h2 class="account__content--title h2 mb-20">Addresses</h2>
                    <a href="{{ route('address.create') }}" class="new__address--btn primary__btn mb-25">Add a new
                        address</a>
                    @foreach ($addresses as $address)
                        <div class="account__content">
                            <div class="account__details two">
                                <div class="address_type d-flex justify-content-start align-items-center gap-2">
                                    <h4 class="account__details--title h4">Address Type: </h4>
                                    <p class="account__details--desc" style="margin:-7px 0 0 0 !important;">
                                        {{ ucwords($address->type) }}
                                        {{ $address->is_default == 1 ? '(Default)' : '' }}</p>
                                </div>
                                <div class="address_type d-flex justify-content-start align-items-center gap-2">
                                    <h4 class="account__details--title h4">Address : </h4>
                                    @php
                                        $addressParts = array_filter([
                                            $address->address_line_1 ?? null,
                                            $address->address_line_2 ?? null,
                                            $address->city ?? null,
                                            $address->state ?? null,
                                            $address->country ?? null,
                                        ]);
                                    @endphp
                                    <p class="account__details--desc" style="margin:-7px 0 0 0 !important;">
                                        {{ ucwords(implode(', ', $addressParts)) }}</p>
                                </div>
                                <div class="address_type d-flex justify-content-start align-items-center gap-2">
                                    <h4 class="account__details--title h4">Postal Code: </h4>
                                    <p class="account__details--desc" style="margin:-7px 0 0 0 !important;">
                                        {{ ucwords($address->postal_code) }}</p>
                                </div>
                            </div>
                            <div class="d-flex gap-3 mb-5 mt-3">
                                <a href="{{ route('address.edit', $address->id) }}"
                                    class="btn py-2 px-5 fs-4 bg-none border-dark rounded-pill c_btn"
                                    type="button">Edit</a>
                                <form action="{{ route('address.destroy', $address->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn py-2 px-5 fs-4 bg-none border-dark rounded-pill c_btn"
                                        type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
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
                                                    <input class="account__login--input" placeholder="Enter new password"
                                                        type="password" name="password" id="password">
                                                </label>
                                                <label>
                                                    <input class="account__login--input"
                                                        placeholder="Enter new confirm Password" type="password"
                                                        name="password_confirmation" id="confirm_password">
                                                </label>

                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="show_pass" class="confirm_show_pass">
                                                    <label class="form-check-label" for="show_pass">
                                                        Show Password
                                                    </label>
                                                </div>

                                                {{-- reCAPTCHA widget --}}
                                                {{-- {!! app('captcha')->display() !!}
                                            <noscript>Please enable Javascript</noscript> --}}
                                                <div class="d-flex justify-content-space-between align-items-center gap-2">
                                                    <button class="account__login--btn primary__btn" type="button"
                                                        id="edit_btn">Edit Username</button>
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
