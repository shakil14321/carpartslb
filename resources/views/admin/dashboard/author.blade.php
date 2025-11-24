@extends('layouts.admin.admin-layout')

@section('content')
<!-- Main content -->
<section class="content">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible notic_bar" style="margin:20px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible notic_bar" style="margin:20px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('error') }}
        </div>
    @endif
    <!-- Small boxes (Stat box) -->
    <div class="row">
        
    </div><!-- /.row -->
    

</section><!-- /.content -->
@endsection