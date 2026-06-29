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
                @foreach ($carParts as $carPart)
                    <!-- Delete confirmation modal -->
                    <div class="modal fade" id="deleteModal{{ $carPart->id }}" tabindex="-1" role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog modal-danger" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Are you sure?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Do you want to delete this product?</p>
                                </div>
                                <div class="modal-footer modal-buttons">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <form action="{{ route('product.destroy', $carPart->id) }}" method="POST">
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

                <!-- search form -->
                <div class="container-fluid" style="margin:0 0 10px 0;">
                    <div class="row">
                        <div class="col-10 col-sm-8 col-md-6 col-offset-1 col-sm-offset-2 col-md-offset-3">
                            <form action="{{ route('productSearch.admin') }}" method="GET" class="w-100">
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
                        <h3 class="box-title">All Product</h3>
                        <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm">Add New Product</a>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('product.deleteSelected') }}" method="POST">
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
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Stock</th>
                                        <th>Brand</th>
                                        <th>Model</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($carParts->count() > 0)
                                        @foreach ($carParts as $carPart)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="ids[]" value="{{ $carPart->id }}"
                                                        class="checkbox">
                                                </td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><img src="{{ $carPart->feature_image ? asset('images/parts/feature/' . $carPart->feature_image) : asset('images/brands/demo.png') }}"
                                                        alt="{{ $carPart->feature_image }}" class="table-brand-image"></td>
                                                <td><a href="{{ route('product.show', $carPart->slug) }}"
                                                        class="all-title">{{ $carPart->title }}</a></td>
                                                <td>{{ $carPart->carPartType ? $carPart->carPartType->title : '' }}</td>
                                                <td>{{ $carPart->stock_type == 'in' ? 'In Stock' : 'Out of Stock' }}</td>
                                                <td>{{ $carPart->carBrand ? $carPart->carBrand->title : '' }}</td>
                                                <td>{{ $carPart->carModel ? "{$carPart->carModel->title} ({$carPart->carModel->year})" : '' }}
                                                </td>
                                                <td>
                                                    <div class="action-container">
                                                        <a href="{{ route('product.edit', $carPart->id) }}"
                                                            class="edit-icon"><i class="fa fa-edit"></i></a>
                                                        <span class="delete-icon fa fa-trash-o" data-toggle="modal"
                                                            data-target="#deleteModal{{ $carPart->id }}"
                                                            data-id="{{ $carPart->id }}"><i></i></span>
                                                        <a href="{{ route('product.view', $carPart->slug) }}"
                                                            class="view-icon"><i class="fa fa-eye"></i></a>
                                                    </div>
                                                </td>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="9" class="text-center">No products found.</td>
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
                        {{ $carParts->links('pagination::bootstrap-4') }}
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const selectAll = document.getElementById("selectAll");
                const checkboxes = document.querySelectorAll(".checkbox");

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
