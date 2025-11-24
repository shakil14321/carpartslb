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
                {{-- Edit address section --}}
                <div class="account__wrapper">
                    <a href="{{ route('customerDashboard') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="#ed1d24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-move-left-icon lucide-move-left">
                            <path d="M6 8L2 12L6 16" />
                            <path d="M2 12H22" />
                        </svg>
                    </a>
                    <h2 class="mt-4">Edit address</h2>
                    <div class="account__content">
                        <form action="{{ route('address.update', $address->id) }}" method="POST">
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
                                                    <input class="account__login--input" placeholder="Address first line"
                                                        type="text" name="address_line_1"
                                                        value="{{ $address->address_line_1 }}">
                                                </label>
                                                <label>
                                                    <input class="account__login--input" placeholder="Address second line"
                                                        type="text" name="address_line_2"
                                                        value="{{ $address->address_line_2 }}">
                                                </label>
                                                <label>
                                                    <input class="account__login--input" placeholder="Enter city"
                                                        type="text" name="city" value="{{ $address->city }}">
                                                </label>

                                                <label>
                                                    <input class="account__login--input" placeholder="Enter state"
                                                        type="text" name="state" value="{{ $address->state }}">
                                                </label>

                                                <label>
                                                    <input class="account__login--input" placeholder="Enter postal code"
                                                        type="number" name="postal_code"
                                                        value="{{ $address->postal_code }}">
                                                </label>

                                                <label>
                                                    <input class="account__login--input" placeholder="Enter country"
                                                        type="text" name="country" value="{{ $address->country }}">
                                                </label>

                                                <!-- Types dropdown -->
                                                <div class="form-group">
                                                    <label for="addressType"></label>
                                                    <select class="form-control account__login--input" name="type"
                                                        id="addressType">
                                                        <option selected disabled>Choose one Type</option>
                                                        <option value="home"
                                                            {{ $address->type === 'home' ? 'selected' : '' }}>Home</option>
                                                        <option value="office"
                                                            {{ $address->type === 'office' ? 'selected' : '' }}>Office
                                                        </option>
                                                    </select>
                                                </div>

                                                <!-- Make default address -->
                                                <div class="form-check form-switch mb-3">
                                                    <input class="form-check-input" type="checkbox" id="defaultAddress"
                                                        name="is_default" value="1"
                                                        {{ $address->is_default ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="defaultAddress">
                                                        Is this address default?
                                                    </label>
                                                </div>

                                                {{-- reCAPTCHA widget --}}
                                                {{-- {!! app('captcha')->display() !!}
                                            <noscript>Please enable Javascript</noscript> --}}
                                                <div class="d-flex justify-content-space-between align-items-center gap-2">
                                                    <a href="{{ route('customerDashboard') }}" class="account__login--btn primary__btn text-center">Back</a>
                                                    <button class="account__login--btn primary__btn" type="submit"
                                                        id="update_btn">Update Address</button>
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
            </div>
        </div>
    </section>
    <!-- my account section end -->

    @include('front.partials.shipping_sec')
@endsection
