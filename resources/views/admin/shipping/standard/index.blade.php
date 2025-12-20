@extends('layouts.admin.admin-layout')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    {{-- Card --}}
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            {{-- <a href="{{ route('shipping.standard.create') }}" class="btn btn-primary btn-sm">Add
                                New</a> --}}
                        </div>

                        <div class="container-fluid" style="margin:0 0 10px 0;">
                            <div class="row">
                                <div class="col-10 col-sm-8 col-md-6 col-offset-1 col-sm-offset-2 col-md-offset-3">
                                    <form action="#" method="GET" class="w-100">
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

                        <div class="col-xs-12">

                            <div class="box">
                                <div class="main-flex">
                                    <h3 class="box-title">All Standard Shipping</h3>
                                    <a href="{{ route('shipping.standard.add') }}" class="btn btn-primary btn-sm">
                                        Add New Standard Shipping
                                    </a>
                                </div><!-- /.box-header -->

                                <div class="box-body">

                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="account__table--header__child--items" style="width:60px;">
                                                    <input type="checkbox" id="selectAll"> All
                                                </th>
                                                <th>Sr #</th>
                                                <th>Name</th>
                                                <th>Cost</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($standardShippings as $key => $shipping)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="ids[]" value="{{ $shipping->id }}"
                                                            class="checkbox">
                                                    </td>

                                                    <td>{{ $standardShippings->firstItem() + $key }}</td>

                                                    <td>
                                                        <a class="all-title">{{ $shipping->title }}</a>
                                                    </td>

                                                    <td>${{ number_format($shipping->cost, 2) }}</td>

                                                    <td>
                                                        @if ($shipping->status == 1)
                                                            <span class="badge badge-success">Active</span>
                                                        @else
                                                            <span class="badge badge-danger">Inactive</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <div class="action-container">
                                                            <a href="{{ route('shipping.standard.edit', $shipping->id) }}"
                                                                class="edit-icon">
                                                                <i class="fa fa-edit"></i>
                                                            </a>

                                                            <form
                                                                action="{{ route('shipping.standard.delete', $shipping->id) }}"
                                                                method="POST" style="display:inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-link p-0 m-0"
                                                                    onclick="return confirm('Are you sure you want to delete this item?');">
                                                                    <i class="delete-icon fa fa-trash-o"></i>
                                                                </button>
                                                            </form>

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            @if ($standardShippings->count() == 0)
                                                <tr>
                                                    <td colspan="6" class="text-center">
                                                        No standard shipping found
                                                    </td>
                                                </tr>
                                            @endif

                                        </tbody>
                                    </table>

                                    <!-- Pagination Links -->
                                    {{ $standardShippings->links('pagination::bootstrap-4') }}

                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->
                    </div>
                    {{-- End Card --}}
                </div>
            </div>
        </div>
    </section>



    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('input.checkbox');

            selectAll.addEventListener('change', function () {
                checkboxes.forEach(cb => cb.checked = selectAll.checked);
            });
        });
    </script>

@endsection