@extends('layouts.admin.admin-layout')

@section('content')
    <section class="content container-fluid">
        <h2>Home Page Settings</h2>

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

            <!-- ================= Top Header Section ================= -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header text-white">
                    <h3 class="mb-0">Top Header Settings</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Shipping Text</label>
                        <input type="text" name="shipping_text" class="form-control"
                            value="{{ $setting?->shipping_text ?? '' }}">
                    </div>

                    <div class="form-group mt-3">
                        <label class="font-weight-bold">Price Guarantee Text</label>
                        <input type="text" name="price_guarantee_text" class="form-control"
                            value="{{ $setting?->price_guarantee_text ?? '' }}">
                    </div>
                </div>
            </div>

            <!-- ================= Footer Section ================= -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header text-white">
                    <h3 class="mb-0">Footer Settings</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="font-weight-bold">About Us Text</label>
                        <textarea name="footer_about_text" class="form-control" rows="4">{{ $setting?->footer_about_text ?? '' }}</textarea>
                    </div>

                    <div class="form-group mt-3">
                        <label class="font-weight-bold">Facebook Link</label>
                        <input type="url" name="footer_facebook_link" class="form-control"
                            value="{{ $setting?->footer_facebook_link ?? '' }}">
                    </div>

                    <div class="form-group mt-3">
                        <label class="font-weight-bold">Instagram Link</label>
                        <input type="url" name="footer_instagram_link" class="form-control"
                            value="{{ $setting?->footer_instagram_link ?? '' }}">
                    </div>
                </div>
            </div>


            <button type="submit" class="btn btn-success">Save Settings</button>
        </form>
    </section>
@endsection
