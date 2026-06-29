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
            @if($brands->count() > 0)
                @foreach($brands as $brand)
                <div class="col-6 col-sm-6 col-md-3 justify-content-center align-items-center mb-5">
                    <div class="brand_img_wrap card mb-4 border">
                        <a href="{{ route('brands.view', $brand->slug) }}"><img src="{{ $brand->brand_image ? asset('images/brands/' . $brand->brand_image) : asset('images/brands/demo.png') }}" alt="{{ $brand->title }}"></a>
                    </div>
                    <h3 class="text-center">{{ $brand->title ?? '' }}</h3>
                </div>
                @endforeach

            @else
            <h3 class="product__card--title">Sub Categoriess not found.</h3>
            @endif

        </div>

        <div class="pagination__area d-flex justify-content-center">

    {{ $brands->links('pagination::bootstrap-4') }}

</div>
    </div>
</section>
{{-- End brands section --}}

<!-- Start shipping section -->
@include('front.partials.shipping_sec')
<!-- End shipping section -->
@endsection
