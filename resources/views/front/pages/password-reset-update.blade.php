@extends('layouts.front.front-layout')

@section('content')
    <!-- Start passwrod reset section  -->
    <div class="login__section section--padding">
        <div class="container">
            <form action="{{ route('password.update') }}" method="POST">
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
                                </div>
                                <div class="account__login--inner">
                                    <input type="hidden" name="email" value="{{ $email }}">
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <label>
                                        <input class="account__login--input" placeholder="Enter new password"
                                            type="password" name="password" id="password">
                                    </label>
                                    <label>
                                        <input class="account__login--input" placeholder="Confirm Password" type="password"
                                            name="password_confirmation" id="confirm_password">
                                    </label>

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" value="" id="show_pass"
                                            class="confirm_show_pass">
                                        <label class="form-check-label" for="show_pass">
                                            Show Password
                                        </label>
                                    </div>
                                    {{-- reCAPTCHA widget --}}
                                    {{-- {!! app('captcha')->display() !!}
                                <noscript>Please enable Javascript</noscript> --}}
                                    <button class="account__login--btn primary__btn" type="submit">Update Password</button>
                                    <div class="account__login--divide">
                                        <span class="account__login--divide__text">OR</span>
                                    </div>
                                    <p class="account__login--signup__text">Don,t Have an Account? <a
                                            href="{{ route('register.form') }}">Sign up now</a></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Start shipping section -->
    @include('front.partials.shipping_sec')
    <!-- End shipping section -->

    <!-- End passwrod reset section  -->
    {{-- {!! NoCaptcha::renderJs() !!} --}}
@endsection
