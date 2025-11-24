@extends('layouts.admin.admin-layout')

@section('content')
<section class="content container-fluid">
    <h2>Site Settings</h2>
    <p>Enter mark google verification code.</p>
    <div class="guide-box" style="margin:0 0 10px 0;">
        <code>
            &lt;meta name="google-site-verification" content="<mark class="bg-success">AbCdEfGhIjKlMnOpQrStUvWxYz1234567890</mark>" /&gt;
        </code>
    </div>


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
            <label for="googleVerification">Google Site Verification</label>
            <input type="text" id="googleVerification" name="google_verification" value="{{ $setting->google_verification ?? '' }}" class="form-control" placeholder="AbCdEfGhIjKlMnOpQrStUvWxYz1234567890">
        </div>

        <button type="submit" class="btn btn-success">Save Settings</button>
    </form>
</section>
@endsection
