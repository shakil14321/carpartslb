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
                        <ul class="breadcrumb__content--menu d-flex justify-content-center">
                            <li class="breadcrumb__content--menu__items"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb__content--menu__items"><span>Contact Us</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->

    <!-- Start contact section -->
    <section class="contact__section section--padding">
        <div class="container">
            <div class="contact__section--heading text-center mb-40">
                <h2 class="contact__section--heading__maintitle">Get In Touch</h2>
                <p class="contact__section--heading__desc">Have questions about our auto parts? Get in touch with us today
                    for quick support, expert advice, and reliable service.</p>
            </div>
            <div class="main__contact--area position__relative">
                <div class="contact__form">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 main-danger notic_bar"
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
                        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 notic_bar"
                            role="alert" style="margin:20px; border-radius:8px;">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <h3 class="contact__form--title mb-30">Contact Me</h3>
                    <form class="contact__form--inner" action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="contact__form--list mb-20">
                                    <label class="contact__form--label" for="firstName">First Name <span
                                            class="contact__form--label__star">*</span></label>
                                    <input class="contact__form--input" name="first_name" id="firstName"
                                        placeholder="Your First Name" type="text" value="{{ old('first_name') }}"
                                        autocomplete>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="contact__form--list mb-20">
                                    <label class="contact__form--label" for="lastName">Last Name <span
                                            class="contact__form--label__star">*</span></label>
                                    <input class="contact__form--input" name="last_name" id="lastName"
                                        placeholder="Your Last Name" type="text" value="{{ old('last_name') }}"
                                        autocomplete>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="contact__form--list mb-20">
                                    <label class="contact__form--label" for="phoneNumber">Phone Number <span
                                            class="contact__form--label__star">*</span></label>
                                    <input class="contact__form--input" name="phone" value="{{ old('phone') }}"
                                        id="phoneNumber" placeholder="Phone number" type="text" autocomplete>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="contact__form--list mb-20">
                                    <label class="contact__form--label" for="mail">Email <span
                                            class="contact__form--label__star">*</span></label>
                                    <input class="contact__form--input" name="email" id="mail" placeholder="Email"
                                        type="text" value="{{ old('email') }}" autocomplete>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="contact__form--list mb-15">
                                    <label class="contact__form--label" for="msg">Write Your Message <span
                                            class="contact__form--label__star">*</span></label>
                                    <textarea class="contact__form--textarea" name="message" id="msg" placeholder="Write Your Message"
                                        value="{{ old('message') }}"></textarea>
                                </div>
                            </div>
                        </div>
                        <button class="contact__form--btn primary__btn" type="submit"> <span>Submit Now</span></button>
                    </form>
                </div>
                <div class="contact__info border-radius-5">
                    <div class="contact__info--items">
                        <h3 class="contact__info--content__title text-white mb-15">Contact Us</h3>
                        <div class="contact__info--items__inner d-flex">
                            <div class="contact__info--icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="31" height="31" fill="white"
                                    stroke="white" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                    <path
                                        d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                                </svg>
                            </div>
                            <div class="contact__info--content">
                                <p class="contact__info--content__desc text-white">Contact by whatsapp <br> <a
                                        href="http://wa.me/+96176380584">+961 76 380 584</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="contact__info--items">
                        <h3 class="contact__info--content__title text-white mb-15">Email Address</h3>
                        <div class="contact__info--items__inner d-flex">
                            <div class="contact__info--icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="31.57" height="31.13"
                                    viewBox="0 0 31.57 31.13">
                                    <path id="ic_email_24px"
                                        d="M30.413,4H5.157C3.421,4,2.016,5.751,2.016,7.891L2,31.239c0,2.14,1.421,3.891,3.157,3.891H30.413c1.736,0,3.157-1.751,3.157-3.891V7.891C33.57,5.751,32.149,4,30.413,4Zm0,7.783L17.785,21.511,5.157,11.783V7.891l12.628,9.728L30.413,7.891Z"
                                        transform="translate(-2 -4)" fill="currentColor" />
                                </svg>
                            </div>
                            <div class="contact__info--content">
                                <p class="contact__info--content__desc text-white align-middle"> <a
                                        href="mailto:carpartslbinfo@gmail.com">carpartslbinfo@gmail.com</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="contact__info--items">
                        <h3 class="contact__info--content__title text-white mb-15">Follow Us</h3>
                        <ul class="contact__info--social d-flex">
                            <li class="contact__info--social__list">
                                <a class="contact__info--social__icon" target="_blank"
                                    href="{{ $setting && $setting->footer_facebook_link ? $setting->footer_facebook_link : 'javascript:void(0)' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="7.667" height="16.524"
                                        viewBox="0 0 7.667 16.524">
                                        <path data-name="Path 237"
                                            d="M967.495,353.678h-2.3v8.253h-3.437v-8.253H960.13V350.77h1.624v-1.888a4.087,4.087,0,0,1,.264-1.492,2.9,2.9,0,0,1,1.039-1.379,3.626,3.626,0,0,1,2.153-.6l2.549.019v2.833h-1.851a.732.732,0,0,0-.472.151.8.8,0,0,0-.246.642v1.719H967.8Z"
                                            transform="translate(-960.13 -345.407)" fill="currentColor"></path>
                                    </svg>
                                    <span class="visually-hidden">Facebook</span>
                                </a>
                            </li>
                            <li class="contact__info--social__list">
                                <a class="contact__info--social__icon" target="_blank"
                                    href="{{ $setting && $setting->footer_instagram_link ? $setting->footer_instagram_link : 'javascript:void(0)' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16.497" height="16.492"
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
                </div>
            </div>
        </div>
    </section>
    <!-- End contact section -->


    <!-- Start shipping section -->
    @include('front.partials.shipping_sec')
    <!-- End shipping section -->
@endsection
