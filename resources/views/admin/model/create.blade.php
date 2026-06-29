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
                    <h3 class="box-title">Add New Car Model</h3>
                    <a href="{{ route('model.index') }}" class="btn btn-primary btn-sm">All Models</a>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('model.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="input-title">Model Name</label>
                            <input type="text" class="form-control brand-name" id="input-title"
                                placeholder="Enter car model name" name="title" value="{{ old('title') }}">
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" id="input-slug" placeholder="Slug will generate"
                                name="slug" value="{{ old('slug') }}" readonly>
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-warning" id="slug-edit-button">Edit</button>
                                <button type="button" class="btn btn-success" id="slug-edit-save-button">Save</button>
                            </div>
                        </div>

                        <!-- Main content -->
                        <section class="content">

                            <div class='row'>
                                <label for="brandName">Model Description (Optional)</label>
                                <div class='col-md-12'>
                                    <div class='box'>
                                        <div class='box-header'>
                                            <!-- tools box -->
                                            <div class="pull-right box-tools">
                                                <button class="btn btn-default btn-sm" data-widget='collapse'
                                                    data-toggle="tooltip" title="Collapse"><i
                                                        class="fa fa-minus"></i></button>
                                            </div><!-- /. tools -->
                                        </div><!-- /.box-header -->
                                        <div class='box-body pad'>

                                            <textarea class="textarea summernote" name="description">{{ old('description') }}</textarea>

                                        </div>
                                    </div>
                                </div><!-- /.col-->
                            </div><!-- ./row -->
                        </section><!-- /.content -->

                        <!-- Brand dropdown -->
                        <div class="form-group">
                            <label>Choose Brand</label>
                            <select class="form-control" name="car_brand_id">
                                <option selected disabled>Choose one brand</option>
                                @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('car_brand_id')==$brand->id ? 'selected' :
                                    ''
                                    }}>{{ ($brand->title) ? $brand->title : '' }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Model years -->
                        <div class="form-group">
                            <label>Model Year</label>
                            <select class="form-control" name="year">
                                <option selected disabled>Choose model year</option>
                                @for($year = 1980; $year <= 2025; $year++) <option value="{{ $year }}" {{
                                    old('year')==$year ? 'selected' : '' }}>
                                    {{ $year }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="imageFile">Model Image (Optional)</label>
                            <input type="file" id="imageFile" name="model_image">
                            <br>
                            <img src="{{ old('model_image') ? asset('images/models/' . old('model_image')) : asset('images/brands/demo.png') ; }}"
                                alt="" class="edit-add-image" id="brandImagePreview">
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Add Model</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div> <!-- /.row -->
</section><!-- /.content -->
@endsection
