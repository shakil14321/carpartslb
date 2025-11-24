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
        
        <!-- Announcement Bar -->
        <div class="mb-3 form-group">
            <label>Announcement Bar</label>
            <textarea name="notice_bar" class="form-control textarea summernote" rows="2">{{ $setting->notice_bar ?? '' }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Save Settings</button>
    </form>
</section>
@endsection
