<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
{{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/front/img/favicon.jpg') }}">

<!-- Google site verification -->
@php
    $setting = \App\Models\SiteSetting::first();
    $carParts;
@endphp
<meta name="google-site-verification"
    content="{{ $setting && $setting->google_verification ? $setting->google_verification : '' }}" />

<!-- ======= All CSS Plugins here ======== -->
<link rel="stylesheet" href="{{ asset('assets/front/css/plugins/swiper-bundle.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/front/css/plugins/glightbox.min.css') }}">
<link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500&display=swap"
    rel="stylesheet">

<!-- Plugin css -->
<link rel="stylesheet" href="{{ asset('assets/front/css/vendor/bootstrap.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Custom Style CSS -->
<link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}">
<!-- My custom Style CSS -->
<link rel="stylesheet" href="{{ asset('assets/front/css/custom.css') }}">
