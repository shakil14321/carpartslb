@extends('layouts.admin.admin-layout')

@section('content')
<!-- Main content -->

    @if (session('success'))
        <div class="alert alert-success alert-dismissible notic_bar" style="margin:20px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('success') }}
        </div>
    @endif
            
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible notic_bar" style="margin:20px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session('error') }}
        </div>
    @endif
            
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="main-flex">
                    <h3 class="box-title">Review Reply</h3>
                    <a href="{{ route('review.index') }}" class="btn btn-primary btn-sm">All Reviews</a>
                </div><!-- /.box-header -->
                <!-- form start -->
               <form action="{{ route('review.update', $review->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group">
                            <input type="hidden" name="reply_admin_name" value="{{ Auth::user()->name ?? '' }}" />
                            <textarea class="form-control" name="reply" placeholder="Reply........">{{ $review->reply ?? '' }}</textarea>
                    </div>
                
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Reply</button>
                    </div>
                </form>

            </div><!-- /.box -->
        </div> <!-- /.row -->
</section><!-- /.content -->
@endsection
