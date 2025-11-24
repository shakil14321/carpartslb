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
                    <h3 class="box-title">Update Order</h3>
                    <a href="{{ route('orderView.admin') }}" class="btn btn-primary btn-sm">All Orders</a>
                </div><!-- /.box-header -->
                <!-- form start -->
               <form action="{{ route('order.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group">
                            <label>Change Order Status</label>
                            <select class="form-control" name="status">
                                <option value="{{ $order->status ?? '' }}" selected>
                                    {{ ucwords($order->status ?? '') }}
                                </option>
                                <option value="process">Process</option>
                                <option value="deliver">Deliver</option>
                                <option value="complete">Complete</option>
                                <option value="cancel">Cancel</option>
                            </select>
                        </div>
                    </div>
                
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Update Order Status</button>
                    </div>
                </form>

            </div><!-- /.box -->
        </div> <!-- /.row -->
</section><!-- /.content -->
@endsection
