@extends('layouts.admin.admin-layout')

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="row">

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


            <div class="col-xs-12">

                @foreach ($types as $type)
                    <!-- Delete confirmation modal -->
                    <div class="modal fade" id="deleteModal{{ $type->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-danger" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Are you sure?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Do you want to delete this type?</p>
                                </div>
                                <div class="modal-footer modal-buttons">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <form action="{{ route('type.destroy', $type->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" id="confirmDelete">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Delete confirmation modal -->
                @endforeach

                <!-- Search form -->
                <div class="container-fluid" style="margin:0 0 10px 0;">
                    <div class="row">
                        <div class="col-10 col-sm-8 col-md-6 col-offset-1 col-sm-offset-2 col-md-offset-3">
                            <form action="{{ route('typeSearch.admin') }}" method="GET" class="w-100">
                                <div class="input-group">
                                    <input type="text" name="q" class="form-control" value="{{ $q ?? '' }}"
                                        placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="box">
                    <div class="main-flex">
                        <h3 class="box-title">All Product Types</h3>
                        <a href="{{ route('type.create') }}" class="btn btn-primary btn-sm">Add New Category</a>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('type.deleteSelected') }}" method="POST">
                            @csrf

                            <button type="submit" class="btn btn-danger" style="margin-bottom:10px;">Delete
                                Selected</button>

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="account__table--header__child--items" style="width:60px;">
                                            <input type="checkbox" id="selectAll"> All
                                        </th>
                                        <th>Sr #</th>
                                        <th>Type Image</th>
                                        <th>Type Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($types->count() > 0)
                                        @foreach ($types as $type)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="ids[]" value="{{ $type->id }}"
                                                        class="checkbox">
                                                </td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><img src="{{ $type->part_type_image ? asset('public/images/types/' . $type->part_type_image) : asset('public/images/brands/demo.png') }}"
                                                        alt="{{ $type->part_type_image }}" class="table-brand-image"></td>
                                                <td><a href="#" class="all-title">{{ $type->title ?? '' }}</a></td>
                                                <td>
                                                    <div class="action-container">
                                                        <a href="{{ route('type.edit', $type->id) }}" class="edit-icon"><i
                                                                class="fa fa-edit"></i></a>
                                                        <span class="delete-icon fa fa-trash-o" data-toggle="modal" data-target="#deleteModal{{ $type->id }}" data-id="{{ $type->id }}"><i></i></span>
                                                        <a href="{{ route('type.view', $type->slug) }}"
                                                            class="view-icon"><i class="fa fa-eye"></i></a>
                                                    </div>
                                                </td>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">No products categories found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                                {{-- <tfoot>
                            <tr>
                                <th>Rendering engine</th>
                                <th>Browser</th>
                                <th>Platform(s)</th>
                                <th>Engine version</th>
                                <th>CSS grade</th>
                            </tr>
                        </tfoot> --}}
                            </table>
                        </form>
                        <!-- Pagination Links -->
                        {{ $types->links('pagination::bootstrap-4') }}
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const selectAll = document.getElementById("selectAll");
                const checkboxes = document.querySelectorAll(".checkbox");

                if (!selectAll || !checkboxes) return;

                selectAll.addEventListener("change", function() {
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = selectAll.checked;
                    });
                });

                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener("change", function() {
                        if (!this.checked) {
                            selectAll.checked = false;
                        } else if (document.querySelectorAll(".checkbox:checked").length === checkboxes
                            .length) {
                            selectAll.checked = true;
                        }
                    });
                });
            });
        </script>

    </section><!-- /.content -->

@endsection
