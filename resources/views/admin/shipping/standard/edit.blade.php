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
                        <h3 class="box-title">Edit Standard Shipping</h3>
                        <a href="{{ route('shipping.standard.index') }}" class="btn btn-primary btn-sm">
                            All standard shipping
                        </a>
                    </div><!-- /.box-header -->

                    <!-- form start -->
                    <form role="form"
                          action="{{ route('shipping.standard.update', $shipping->id) }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="box-body">
                            <div class="box-body">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="input-name">Name</label>
                                            <input type="text"
                                                   class="form-control"
                                                   id="input-name"
                                                   placeholder="Enter shipping name"
                                                   name="title"
                                                   value="{{ old('title', $shipping->title) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="input-cost">Cost</label>
                                            <input type="text"
                                                   class="form-control"
                                                   id="input-cost"
                                                   placeholder="Enter shipping cost"
                                                   name="cost"
                                                   value="{{ old('cost', $shipping->cost) }}">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="1"
                                                    {{ old('status', $shipping->status) == 1 ? 'selected' : '' }}>
                                                    Active
                                                </option>
                                                <option value="0"
                                                    {{ old('status', $shipping->status) == 0 ? 'selected' : '' }}>
                                                    Inactive
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">
                                Update standard shipping
                            </button>
                        </div>

                    </form>
                </div><!-- /.box -->
            </div>
        </div>
    </section><!-- /.content -->
@endsection
