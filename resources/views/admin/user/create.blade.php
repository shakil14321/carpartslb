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
                        <h3 class="box-title">Add New User</h3>
                        <a href="{{ route('user.index') }}" class="btn btn-primary btn-sm">All Users</a>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="input-title">Username</label>
                                <input type="text" class="form-control brand-name" id="input-title"
                                    placeholder="Enter username" name="name" value="{{ old('name') }}">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first-name">First Name</label>
                                        <input type="text" class="form-control brand-name" id="first-name"
                                            placeholder="Enter first name" name="first_name"
                                            value="{{ old('first_name') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last-name">Last Name</label>
                                        <input type="text" class="form-control brand-name" id="last-name"
                                            placeholder="Enter last name" name="last_name" value="{{ old('last_name') }}">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="input-email">Email</label>
                                <input type="email" class="form-control" id="input-email" placeholder="Enter email"
                                    name="email" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <label for="input-phone">Phone Number</label>
                                <input type="text" class="form-control" id="input-phone" placeholder="Enter phone number"
                                    name="phone" value="{{ old('phone') }}">
                            </div>

                            <div class="form-group">
                                <label for="input-pass">Password</label>
                                <input type="password" class="form-control" id="input-pass" placeholder="Enter password"
                                    name="password">
                            </div>

                            <div class="form-group">
                                <label for="input-pass-conf">Confirm Password</label>
                                <input type="password" class="form-control" id="input-pass-conf"
                                    placeholder="Enter password" name="password_confirmation">
                            </div>

                            <!-- select users -->
                            <div class="form-group">
                                <label for="user_role">Select Role</label>
                                <select class="form-control" name="role" id="user_role">
                                    <option selected disabled>Choose one role</option>
                                    <option value="admin">Admin</option>
                                    <option value="author">Author</option>
                                    <option value="customer">Customer</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="imageFile">User Image (Optional)</label>
                                <input type="file" id="imageFile" name="user_image">
                                <br>
                                <img src="{{ old('user_image') ? asset('images/users/' . old('user_image')) : asset('images/brands/demo.png') }}"
                                    alt="" class="edit-add-image" id="brandImagePreview">
                            </div>


                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Add User</button>
                            </div>
                    </form>
                </div><!-- /.box -->
            </div> <!-- /.row -->
    </section><!-- /.content -->
@endsection
