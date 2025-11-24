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
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible notic_bar" style="margin:20px;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session('error') }}
                </div>
            @endif
            
            <!-- Search form -->
            <div class="container-fluid" style="margin:0 0 10px 0;">
                            <div class="row">
                                <div class="col-10 col-sm-8 col-md-6 col-offset-1 col-sm-offset-2 col-md-offset-3">
                                    <form action="{{ route('orderCompleteSearch.admin') }}" method="GET" class="w-100">
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
                        <h3 class="box-title">All Completed Orders</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">

                        {{-- Delete Confirmation Modal --}}
                        @foreach ($orders as $order)
                            <div class="modal fade" id="deleteModal{{ $order->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-danger" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Are you sure?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Do you want to delete this brand?</p>
                                        </div>
                                        <div class="modal-footer modal-buttons">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                            <form action="{{ route('order.destroy', $order->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    id="confirmDelete">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- End Delete Confirmation Modal --}}

                        <form action="{{ route('orders.deleteSelected') }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger" style="margin-bottom:10px;">Delete Selected</button>

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="account__table--header__child">
                                        <th class="account__table--header__child--items" style="width:60px;">
                                            <input type="checkbox" id="selectAll"> All
                                        </th>
                                        <th class="account__table--header__child--items">Sr #</th>
                                        <th class="account__table--header__child--items">Order #</th>
                                        <th class="account__table--header__child--items">Customer Name</th>
                                        <th class="account__table--header__child--items">Date & Time</th>
                                        <th class="account__table--header__child--items">Payment</th>
                                        <th class="account__table--header__child--items">Status</th>
                                        <th class="account__table--header__child--items">Total</th>
                                        <th class="account__table--header__child--items">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($orders->count() > 0)
                                        @foreach ($orders as $order)
                                            <tr class="account__table--body__child">
                                                <td>
                                                    <input type="checkbox" name="ids[]" value="{{ $order->id }}" class="checkbox">
                                                </td>
                                                <td class="account__table--body__child--items">{{ $loop->iteration }}</td>
                                                <td class="account__table--body__child--items">
                                                    <a href="{{ route('order.view', $order->id) }}">{{ $order->order_number ?? '' }}</a>
                                                </td>
                                                <td class="account__table--body__child--items">
                                                    {{ ucwords(trim(($order->first_name ?? '') . ' ' . ($order->last_name ?? ''))) }}
                                                </td>
                                                <td class="account__table--body__child--items">{{ $order->updated_at ?? '' }}</td>
                                                <td class="account__table--body__child--items">{{ strtoupper($order->payment_method) ?? '' }}</td>
                                                <td class="account__table--body__child--items">{{ ucwords($order->status) ?? '' }}</td>
                                                <td class="account__table--body__child--items">{{ $order->total ? $order->total : '' }}</td>
                                                <td>
                                                    <div class="action-container">
                                                        <a href="{{ route('order.edit', $order->id) }}" class="edit-icon"><i class="fa fa-edit"></i></a>
                                                        <span class="delete-icon fa fa-trash-o" data-toggle="modal" data-target="#deleteModal{{ $order->id }}" data-id="{{ $order->id }}"><i></i></span>
                                                        
                                                        <a href="{{ route('order.view', $order->id) }}" class="view-icon"><i class="fa fa-eye"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="account__table--body__child">
                                            <td colspan="9" class="account__table--body__child--items text-center">Orders not found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </form>

                        <!-- Pagination Links -->
                        {{ $orders->links('pagination::bootstrap-4') }}
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const selectAll = document.getElementById("selectAll");
        const checkboxes = document.querySelectorAll(".checkbox");

        selectAll.addEventListener("change", function () {
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
        });

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("change", function () {
                if (!this.checked) {
                    selectAll.checked = false;
                } else if (document.querySelectorAll(".checkbox:checked").length === checkboxes.length) {
                    selectAll.checked = true;
                }
            });
        });
    });
</script>

    </section><!-- /.content -->

@endsection
