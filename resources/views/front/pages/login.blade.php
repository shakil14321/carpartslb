@extends('layouts.front.front-layout')

@section('content')
    <!-- Start login section  -->
    <div class="login__section section--padding">
        <div class="container">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="login__section--inner">
                    <div class="row row-cols-md-2 row-cols-1 d-flex justify-content-center align-items-center">
                        <div class="col">
                            <div class="account__login">
                                <div class="account__login--header mb-25">
                                    <h2 class="account__login--header__title mb-10">Login</h2>
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
                                    <p class="account__login--header__desc">Login if you are a returning customer.
                                    </p>
                                </div>
                                <div class="account__login--inner">
                                    <label>
                                        <input class="account__login--input" placeholder="Email Address" type="email"
                                            name="email" value="{{ old('email') }}">
                                    </label>
                                    <label>
                                        <input class="account__login--input user_password" placeholder="Password"
                                            type="password" name="password">
                                    </label>

                                    <div class="form-check form-switch mb-4">
                                        <input class="form-check-input show_password" type="checkbox" role="switch"
                                            id="show_pass">
                                        <label class="form-check-label" for="show_pass">Show Password</label>
                                    </div>

                                    <div
                                        class="account__login--remember__forgot mb-15 d-flex justify-content-between align-items-center">
                                        <div class="account__login--remember position__relative">
                                            <input class="checkout__checkbox--input" id="check1" type="checkbox"
                                                name="remember">
                                            <span class="checkout__checkbox--checkmark"></span>
                                            <label class="checkout__checkbox--label login__remember--label" for="check1">
                                                Remember me</label>
                                        </div>
                                        <a href="{{ route('password.request') }}" class="account__login--forgot"
                                            type="submit">Forgot Your
                                            Password?</a>
                                    </div>
                                    {{-- reCAPTCHA widget --}}
                                    {{-- {!! app('captcha')->display() !!}
                                <noscript>Please enable Javascript</noscript> --}}
                                    <input type="hidden" name="role" value="customer">
                                    <button class="account__login--btn primary__btn" type="submit">Login</button>
                                    <div class="account__login--divide">
                                        <span class="account__login--divide__text">OR</span>
                                    </div>
                                    <p class="account__login--signup__text">Don't Have an Account? <a
                                            href="{{ route('register.form') }}">Sign up now</a></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End login section  -->

    <!-- Start shipping section -->
    @include('front.partials.shipping_sec')
    <!-- End shipping section -->

    {{-- {!! NoCaptcha::renderJs() !!} --}}
@endsection
