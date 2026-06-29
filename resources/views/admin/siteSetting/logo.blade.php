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

        <!-- Logo -->
        <div class="form-group">
            <label for="imageFile">Logo Image</label>
            <input type="file" id="imageFile" name="site_logo">
            <br>
            <img src="{{ $setting && $setting->site_logo ? asset('images/logos/' . $setting->site_logo) : asset('images/brands/demo.png') ; }}"
                alt="" class="edit-add-image" id="brandImagePreview" style="width:300px !important;">
        </div>

        <button type="submit" class="btn btn-success">Save Settings</button>
    </form>
</section>
@endsection
