@extends('layouts.front.front-layout')

@section('content')

{{-- Brands section start --}}
<section class="brands_section">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-10 col-md-4 text-center">
                <div class="brand_heading text-center section__heading--maintitle px-3"><h2>Select By Part Brands</h2></div>
            </div>
        </div>
        <div class="row">
            @if($partBrands->count() > 0)
                @foreach($partBrands as $partBrand)
                <div class="col-6 col-sm-6 col-md-3 justify-content-center align-items-center mb-5">
                    <div class="brand_img_wrap card mb-4 border">
                        <a href="{{ route('partBrands.view', $partBrand->slug) }}"><img src="{{ $partBrand->brand_image ? asset('public/images/brands/' . $partBrand->brand_image) : asset('public/images/brands/demo.png') }}" alt="{{ $partBrand->title }}"></a>
                    </div>
                    <h3 class="text-center">{{ $partBrand->title ?? '' }}</h3>
                </div>
                @endforeach
                
            @else
            <h3 class="product__card--title">Part Brands not found.</h3>
            @endif
            
        </div>
        
        <div class="pagination__area d-flex justify-content-center">

    {{ $partBrands->links('pagination::bootstrap-4') }}

</div>
    </div>
</section>
{{-- End brands section --}}

<!-- Start shipping section -->
@include('front.partials.shipping_sec')
<!-- End shipping section -->
@endsection
