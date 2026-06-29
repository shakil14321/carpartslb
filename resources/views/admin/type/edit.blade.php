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
                    <h3 class="box-title">Update Product Type</h3>
                    <a href="{{ route('type.index') }}" class="btn btn-primary btn-sm">All Types</a>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('type.update', $type->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="box-body">
                        <div class="form-group">
                            <label for="input-title">Type Name</label>
                            <input type="text" class="form-control brand-name" id="input-title"
                                placeholder="Enter car type name" name="title" value="{{ old('title', $type->title) }}">
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" id="input-slug" placeholder="Slug will generate"
                                name="slug" value="{{ old('slug', $type->slug) }}" readonly>
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-warning" id="slug-edit-button">Edit</button>
                                <button type="button" class="btn btn-success" id="slug-edit-save-button">Save</button>
                            </div>
                        </div>

                        <!-- Main content -->
                        <section class="content">

                            <div class='row'>
                                <label for="brandName">Type Description (Optional)</label>
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

                                            <textarea class="textarea summernote" name="description">{{ old('description', $type->description) }}</textarea>

                                        </div>
                                    </div>
                                </div><!-- /.col-->
                            </div><!-- ./row -->
                        </section><!-- /.content -->

                        <div class="form-group">
                            <label for="imageFile">Type Image (Optional)</label>
                            <input type="file" id="imageFile" name="part_type_image">
                            <br>
                            <img src="{{ old('part_type_image', $type->part_type_image) ? asset('images/types/' . old('part_type_image', $type->part_type_image)) : asset('images/brands/demo.png') ; }}"
                                alt="" class="edit-add-image" id="brandImagePreview">
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Update Type</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div> <!-- /.row -->
</section><!-- /.content -->
@endsection
