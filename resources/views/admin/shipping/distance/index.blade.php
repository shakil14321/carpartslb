




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






                        <div class="col-xs-12">

                            <div class="box">
                                <div class="main-flex">
                                    <h3 class="box-title">Distance Based Shipping</h3>
                                  
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <form action="#" method="POST">
                                        @csrf

                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="account__table--header__child--items" style="width:60px;">
                                                        <input type="checkbox" id="selectAll"> All
                                                    </th>
                                                    <th>Sr #</th>
                                                    <th>Per KM Cost</th>
                                                    <th>Minimum Cost</th>
                                                    <th>Maximum Cost</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="ids[]" 
                                                            class="checkbox">
                                                    </td>
                                                    <td>1</td>
                                                    
                                                    <td><a class="all-title">$1.0</a></td>
                                                    <td>$0.5</td>
                                                    <td>$2.0</td>
                                                    <td>
                                                        <div class="action-container">
                                                            <a href="{{ route('shipping.distance.edit', 1) }}"
                                                                class="edit-icon"><i class="fa fa-edit"></i></a>
                                                            <a href="javascript:void(0)">
                                                                
                                                            </a>
                                                            <a href="#"
                                                                class="view-icon"><i class="delete-icon fa fa-trash-o"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="ids[]" 
                                                            class="checkbox">
                                                    </td>
                                                    <td>2</td>
                                                    
                                                    <td><a class="all-title">$2</a></td>
                                                    <td>$1</td>
                                                    <td>$2.0</td>
                                                    <td>
                                                        <div class="action-container">
                                                            <a href="{{ route('shipping.distance.edit', 2) }}"
                                                                class="edit-icon"><i class="fa fa-edit"></i></a>
                                                            <a href="javascript:void(0)">
                                                                
                                                            </a>
                                                            <a href="#"
                                                                class="view-icon"><i class="delete-icon fa fa-trash-o"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>

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
                                    {{-- {{ $carBrands->links('pagination::bootstrap-4') }} --}}
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->
                    </div>
                    {{-- End Card --}}
                </div>
            </div>
        </div>
    </section>

    {{-- Delete Modals --}}
    <div class="modal fade" id="deleteModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete <strong>Standard Shipping 1</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger btn-sm">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete <strong>Standard Shipping 2</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger btn-sm">Delete</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Select all checkbox JS --}}
    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const selectAll = document.getElementById('selectAll');
                const checkboxes = document.querySelectorAll('input[name="selected[]"]');

                selectAll.addEventListener('change', function () {
                    checkboxes.forEach(cb => cb.checked = selectAll.checked);
                });
            });
        </script>
    @endpush
@endsection
