@extends('layouts.admin.admin-layout')

@section('content')
<section class="content container-fluid">
    <h2>Site Settings</h2>

    <!-- Alert messages -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible" style="margin:20px;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible" style="margin:20px;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('site.setting.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Home slider images -->
        <div class="container">
            <div class="row">
                
            <div class="col-12">
                <p class="text-danger"><strong>Note:</strong> Always upload the slider image transparant background.</p>
            </div>
                
                <!-- Home slide first image -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="form-group">
                    <label for="imageFile">Home Slider 1st Image</label>
                    <input type="file" id="imageFile" name="carousel_image_one">
                    <br>
                    <img src="{{ $setting && $setting->carousel_image_one ? asset('public/images/banners/' . $setting->carousel_image_one) : asset('public/assets/front/img/slider/home-slider1-layer.png') ; }}"
                        alt="" class="edit-add-image" id="brandImagePreview">
                </div>
            </div>
            
            <!-- Home slide second image -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="form-group">
                    <label for="imageFile">Home Slider 2nd Image</label>
                    <input type="file" id="imageFile" name="carousel_image_two">
                    <br>
                    <img src="{{ $setting && $setting->carousel_image_two ? asset('public/images/banners/' . $setting->carousel_image_two) : asset('public/assets/front/img/slider/home-slider2-layer.png') ; }}"
                        alt="" class="edit-add-image" id="brandImagePreview">
                </div>
            </div>
            
            <!-- Home slide third image -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="form-group">
                    <label for="imageFile">Home Slider 3rd Image</label>
                    <input type="file" id="imageFile" name="carousel_image_three">
                    <br>
                    <img src="{{ $setting && $setting->carousel_image_three ? asset('public/images/banners/' . $setting->carousel_image_three) : asset('public/assets/front/img/slider/home-slider4-layer.png') ; }}"
                        alt="" class="edit-add-image" id="brandImagePreview">
                </div>
            </div>
        </div>
        </div>

        <button type="submit" class="btn btn-success">Save Settings</button>
    </form>
</section>
@endsection
