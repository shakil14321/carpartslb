@extends('layouts.admin.admin-layout')

@section('content')
<section class="container-fluid" style="height:80vh; display:flex; justify-content:center; align-items:center;">
    <div class="text-center">
        <h1 style="font-size:60px;">404 Error</h1>
        <p>Page not found</p>
        <a href="{{ route('dashboard') }}" class="btn btn-success">Back to dashboard</a>
    </div>
</section>
@endsection