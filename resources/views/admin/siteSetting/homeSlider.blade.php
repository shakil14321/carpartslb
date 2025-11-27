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

            <div class="container">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="">
                            <p class="text-danger"><strong>Note:</strong> Always upload the slider image transparant
                                background.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- ================= SLIDER 1 ================= -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header text-white">
                        <h3 class="mb-0">Home Slider 1st</h5>
                    </div>
                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-5">
                                <label class="font-weight-bold">Slider Image</label>
                                <input type="file" name="carousel_image_one" class="mb-2">

                                <div class="border p-2 rounded text-center">
                                    <img src="{{ $setting && $setting->carousel_image_one ? asset('public/images/banners/' . $setting->carousel_image_one) : asset('public/assets/front/img/slider/home-slider1-layer.png') }}"
                                        class="img-fluid rounded" style="max-height:180px;">
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="font-weight-bold">Slider Subtitle</label>
                                    <input type="text" name="slider1_subtitle"
                                        value="{{ $setting->slider1_subtitle ?? '' }}" class="form-control">
                                </div>

                                <div class="form-group mt-3">
                                    <label class="font-weight-bold">Slider Main Title</label>
                                    <input type="text" name="slider1_maintitle"
                                        value="{{ $setting->slider1_maintitle ?? '' }}" class="form-control">
                                </div>

                                <div class="form-group mt-3">
                                    <label class="font-weight-bold">Slider Description</label>
                                    <textarea name="slider1_desc" class="form-control" rows="3">{{ $setting->slider1_desc ?? '' }}</textarea>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <!-- ================= SLIDER 2 ================= -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header text-white">
                        <h3 class="mb-0">Home Slider 2nd</h5>
                    </div>
                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-5">
                                <label class="font-weight-bold">Slider Image</label>
                                <input type="file" name="carousel_image_two" class="form-control mb-2">

                                <div class="border p-2 rounded text-center">
                                    <img src="{{ $setting && $setting->carousel_image_two ? asset('public/images/banners/' . $setting->carousel_image_two) : asset('public/assets/front/img/slider/home-slider2-layer.png') }}"
                                        class="img-fluid rounded" style="max-height:180px;">
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="font-weight-bold">Slider Subtitle</label>
                                    <input type="text" name="slider2_subtitle"
                                        value="{{ $setting->slider2_subtitle ?? '' }}" class="form-control">
                                </div>

                                <div class="form-group mt-3">
                                    <label class="font-weight-bold">Slider Main Title</label>
                                    <input type="text" name="slider2_maintitle"
                                        value="{{ $setting->slider2_maintitle ?? '' }}" class="form-control">
                                </div>

                                <div class="form-group mt-3">
                                    <label class="font-weight-bold">Slider Description</label>
                                    <textarea name="slider2_desc" class="form-control" rows="3">{{ $setting->slider2_desc ?? '' }}</textarea>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <!-- ================= SLIDER 3 ================= -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header text-white">
                        <h3 class="mb-0">Home Slider 3rd</h5>
                    </div>
                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-5">
                                <label class="font-weight-bold">Slider Image</label>
                                <input type="file" name="carousel_image_three" class="form-control mb-2">

                                <div class="border p-2 rounded text-center">
                                    <img src="{{ $setting && $setting->carousel_image_three ? asset('public/images/banners/' . $setting->carousel_image_three) : asset('public/assets/front/img/slider/home-slider4-layer.png') }}"
                                        class="img-fluid rounded" style="max-height:180px;">
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="font-weight-bold">Slider Subtitle</label>
                                    <input type="text" name="slider3_subtitle"
                                        value="{{ $setting->slider3_subtitle ?? '' }}" class="form-control">
                                </div>

                                <div class="form-group mt-3">
                                    <label class="font-weight-bold">Slider Main Title</label>
                                    <input type="text" name="slider3_maintitle"
                                        value="{{ $setting->slider3_maintitle ?? '' }}" class="form-control">
                                </div>

                                <div class="form-group mt-3">
                                    <label class="font-weight-bold">Slider Description</label>
                                    <textarea name="slider3_desc" class="form-control" rows="3">{{ $setting->slider3_desc ?? '' }}</textarea>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Home slider images -->
            {{-- <div class="container">
                <div class="row">

                    <div class="col-12">
                        <p class="text-danger"><strong>Note:</strong> Always upload the slider image transparant background.
                        </p>
                    </div>

                    <!-- Home slide first image -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="imageFile">Home Slider 1st Image</label>
                            <input type="file" id="imageFile" name="carousel_image_one">
                            <br>
                            <img src="{{ $setting && $setting->carousel_image_one ? asset('public/images/banners/' . $setting->carousel_image_one) : asset('public/assets/front/img/slider/home-slider1-layer.png') }}"
                                alt="" class="edit-add-image" id="brandImagePreview">
                        </div>
                    </div>

                    <!-- Home slide second image -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="imageFile">Home Slider 2nd Image</label>
                            <input type="file" id="imageFile" name="carousel_image_two">
                            <br>
                            <img src="{{ $setting && $setting->carousel_image_two ? asset('public/images/banners/' . $setting->carousel_image_two) : asset('public/assets/front/img/slider/home-slider2-layer.png') }}"
                                alt="" class="edit-add-image" id="brandImagePreview">
                        </div>
                    </div>

                    <!-- Home slide third image -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="imageFile">Home Slider 3rd Image</label>
                            <input type="file" id="imageFile" name="carousel_image_three">
                            <br>
                            <img src="{{ $setting && $setting->carousel_image_three ? asset('public/images/banners/' . $setting->carousel_image_three) : asset('public/assets/front/img/slider/home-slider4-layer.png') }}"
                                alt="" class="edit-add-image" id="brandImagePreview">
                        </div>
                    </div>
                </div>
            </div> --}}

            <button type="submit" class="btn btn-success">Save Settings</button>
        </form>
    </section>
@endsection
