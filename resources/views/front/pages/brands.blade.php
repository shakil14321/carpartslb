@extends('layouts.front.front-layout')

@section('content')

{{-- Brands section start --}}
<section class="brands_section">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-10 col-md-4 text-center">
                <div class="brand_heading text-center section__heading--maintitle px-3"><h2>Select By Car Brands</h2></div>
            </div>
        </div>
        <div class="row">
            @if($carBrands->count() > 0)
                @foreach($carBrands as $carBrand)
                <div class="col-6 col-sm-6 col-md-3 justify-content-center align-items-center mb-5">
                    <div class="brand_img_wrap card mb-4 border">
                        <a href="{{ route('carBrands.view', $carBrand->slug) }}"><img src="{{ $carBrand->brand_image ? asset('public/images/brands/' . $carBrand->brand_image) : asset('public/images/brands/demo.png') }}" alt="{{ $carBrand->title }}"></a>
                    </div>
                    <h3 class="text-center">{{ $carBrand->title ?? '' }}</h3>
                </div>
                @endforeach
                
            @else
            <h3 class="product__card--title">Part Brands not found.</h3>
            @endif
            
        </div>
        
        <div class="pagination__area d-flex justify-content-center">

    {{ $carBrands->links('pagination::bootstrap-4') }}

</div>
    </div>
</section>
{{-- End brands section --}}

<!-- Start shipping section -->
@include('front.partials.shipping_sec')
<!-- End shipping section -->
@endsection
