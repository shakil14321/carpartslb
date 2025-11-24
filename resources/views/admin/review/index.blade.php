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

            @foreach($reviews as $review)
                <!-- Delete confirmation modal -->
                <div class="modal fade" id="deleteModal{{ $review->id }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <form action="{{ route('review.destroy', ['id' => $review->id]) }}" method="POST">
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
                        <form action="{{ route('reviewSearch.admin') }}" method="GET" class="w-100">
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
                        <h3 class="box-title">All Customer Reviews</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('review.deleteSelected') }}" method="POST">
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
                                        <th>Username</th>
                                        <th>Review</th>
                                        <th>Email</th>
                                        <th>Rating</th>
                                        <th>Product</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($reviews->count() > 0)
                                        @foreach ($reviews as $review)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="ids[]" value="{{ $review->id }}"
                                                        class="checkbox">
                                                </td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a href="#" class="all-title">{{ $review->username ?? '' }}</a></td> 
                                                <td><a href="{{ route('review.show', $review->id) }}" class="all-title">{{ \Illuminate\Support\Str::words($review->review, 3, '...') }}</a></td> 
                                                <td><a href="#" class="all-title">{{ $review->email ?? '' }}</a></td> 
                                                <td>
                                                @for($i=1; $i <=5; $i++)
                                                    <a href="#" class="edit-icon"><i class="fa fa-star {{ $i <= $review->rating ? 'text-info' : '#a7a8a3'}}"></i></a>
                                                @endfor
                                                </td>
                                                <td><a href="#" class="all-title">{{ $review->product_title ?? '' }}</a></td> 
                                                <td>
                                                    <div class="action-container">
                                                        <span class="delete-icon fa fa-trash-o" data-toggle="modal" data-target="#deleteModal{{ $review->id }}" data-id="{{ $review->id }}"><i></i></span>
                                                        <a href="{{ route('review.edit', $review->id) }}"
                                                            class="edit-icon"><i class="fa fa-reply"></i></a>
                                                        <a href="{{ route('review.show', $review->id) }}"
                                                            class="view-icon"><i class="fa fa-eye"></i></a>
                                                    </div>
                                                </td>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center">No reviews found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </form>
                        <!-- Pagination Links -->
                        {{ $reviews->links('pagination::bootstrap-4') }}
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
