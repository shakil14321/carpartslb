{{-- @extends('layouts.admin.admin-layout')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                       
                    </div>

                    <div class="col-xs-12">
                        <div class="box">
                            <div class="main-flex">
                                <h3 class="box-title">Distance Based Shipping</h3>
                            </div>
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                           
                                            <th>Sr #</th>
                                            <th>Per KM Cost</th>
                                            <th>Minimum Cost</th>
                                            <th>Maximum Cost</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($shippings as $key => $shipping)
                                            <tr>
                                              
                                                <td>{{ $shippings->firstItem() + $key }}</td>
                                                <td>${{ number_format($shipping->per_km_price, 2) }}</td>
                                                <td>${{ number_format($shipping->min_cost, 2) }}</td>
                                                <td>${{ number_format($shipping->max_cost ?? 0, 2) }}</td>
                                             
                                                <td>
                                                    <div class="action-container">
                                                   
                                                        <form action="{{ route('shipping.distance.delete', $shipping->id) }}"
                                                              method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" style="background:none;border:none;padding:0;" onclick="return confirm('Are you sure?')">
                                                                <i class="delete-icon fa fa-trash-o"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No distance shipping found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                {{ $shippings->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const selectAll = document.getElementById('selectAll');

    selectAll.addEventListener('change', function () {
        // each time selectAll click korle sob checkbox query kora hocche
        document.querySelectorAll('input.checkbox').forEach(cb => cb.checked = selectAll.checked);
    });
});

</script>
@endpush
@endsection --}}
