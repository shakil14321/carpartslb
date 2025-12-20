@extends('layouts.admin.admin-layout')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    @if ($errors->any())
                        <div class="alert alert-danger main-danger notic_bar">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="main-flex">
                        <h3 class="box-title">
                            {{ isset($shipping) ? 'Edit Distance Based Shipping' : 'Add Distance Based Shipping' }}
                        </h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form"
                          action="{{ isset($shipping) ? route('shipping.distance.update', $shipping->id) : route('shipping.distance.store') }}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($shipping))
                            @method('PUT')
                        @endif

                        <div class="box-body">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="input-name">Per KM Price</label>
                                            <input type="text" class="form-control" id="input-name"
                                                placeholder="Enter price per KM" name="per_km_price"
                                                value="{{ old('per_km_price', $shipping->per_km_price ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="input-cost">Minimum Cost</label>
                                            <input type="text" class="form-control" id="input-cost"
                                                placeholder="Enter minimum cost" name="min_cost"
                                                value="{{ old('min_cost', $shipping->min_cost ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="input-cost">Maximum Cost</label>
                                            <input type="text" class="form-control" id="input-cost"
                                                placeholder="Enter maximum cost" name="max_cost"
                                                value="{{ old('max_cost', $shipping->max_cost ?? '') }}">
                                        </div>
                                    </div>

                                   

                                </div>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save Change</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div> <!-- /.row -->
    </section><!-- /.content -->
@endsection
