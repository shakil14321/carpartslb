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
                        <h3 class="box-title">Edit User</h3>
                        <a href="{{ route('user.index') }}" class="btn btn-primary btn-sm">All Users</a>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('user.update', $user->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            {{-- Username --}}
                            <div class="form-group">
                                <label for="input-title">Username</label>
                                <input type="text" class="form-control brand-name" id="input-title"
                                    placeholder="Enter username" name="name" value="{{ old('name', $user->name) }}">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first-name">First Name</label>
                                        <input type="text" class="form-control brand-name" id="first-name"
                                            placeholder="Enter first name" name="first_name"
                                            value="{{ old('first_name', $user->first_name) }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last-name">Last Name</label>
                                        <input type="text" class="form-control brand-name" id="last-name"
                                            placeholder="Enter last name" name="last_name" value="{{ old('last_name', $user->last_name) }}">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    {{-- Email --}}
                                    <div class="form-group">
                                        <label for="input-title">Email</label>
                                        <input type="email" class="form-control brand-name" id="input-title"
                                            placeholder="Enter email" name="email" value="{{ old('email', $user->email) }}">
                                    </div>
                                </div>
                                

                                <div class="col-md-6">
                                    {{-- Phone --}}
                                    <div class="form-group">
                                        <label for="input-title">Phone</label>
                                        <input type="tel" class="form-control brand-name" id="input-title"
                                            placeholder="Enter phone" name="phone" value="{{ old('phone', $user->phone) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="user-role">Choose Role</label>
                                <select class="form-control" name="role" id="user-role">
                                   @if($user->role == 'admin')
                                   <option selected disabled>Choose one Type</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="author" {{ $user->role == 'author' ? 'selected' : '' }}>Author</option>
                                    <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
                                   @else
                                    <option value="author" {{ $user->role == 'author' ? 'selected' : '' }}>Author</option>
                                   @endif
                                    
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="imageFile">User Image (Optional)</label>
                                <input type="file" id="imageFile" name="user_image">
                                <br>
                                <img src="{{ old('user_image', $user->user_image) ? asset('public/images/users/' . old('user_image', $user->user_image)) : asset('public/images/brands/demo.png') }}"
                                    alt="" class="edit-add-image" id="brandImagePreview">
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div> <!-- /.row -->
    </section><!-- /.content -->
@endsection
