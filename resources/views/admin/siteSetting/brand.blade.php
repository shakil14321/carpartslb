@extends('layouts.admin.admin-layout')

@section('content')
<section class="content container-fluid">
    <h2>Site Settings</h2>
    <p>How much car brand do you want to show on home page?</p>

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

        <!-- Logo -->
        <div class="form-group">
            <label for="brandQuantity">Brand Quantity</label>
            <input type="number" id="brandQuantity" name="brand_quantity" value="{{ $setting->brand_quantity }}" class="form-control" placeholder="Enter brand quantity">
        </div>

        <button type="submit" class="btn btn-success">Save Settings</button>
    </form>
</section>
@endsection
