@extends('layouts.admin.admin-layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>FWI Products</h1>
        </section>

        <section class="content">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Source ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Imported</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($products as $product)
                    @php
                        $exists = \App\Models\FwiProduct::where('source_product_id', $product['source_product_id'])->exists();
                    @endphp

                    <tr>
                        <td>
                            @if(!empty($product['image']))
                                <img src="{{ $product['image'] }}" width="50">
                            @endif
                        </td>

                        <td>{{ $product['source_product_id'] }}</td>
                        <td>{{ $product['product_name'] }}</td>
                        <td>{{ $product['source_price'] }}</td>

                        <td>
                            @if($exists)
                                <span class="label label-success">Yes</span>
                            @else
                                <span class="label label-warning">No</span>
                            @endif
                        </td>

                        <td>
                            @if($exists)
                                <span class="btn btn-sm btn-success disabled">Added</span>
                            @else
                                <a href="{{ route('fwi-products.add', $product['source_product_id']) }}"
                                   class="btn btn-sm btn-primary">
                                    Add Product
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

                <div class="text-end">
                    <ul class="pagination">

                        @if(($pagination['current_page'] ?? 1) > 1)
                            <li>
                                <a href="{{ request()->fullUrlWithQuery([
                    'page' => $pagination['current_page'] - 1
                ]) }}">
                                    «
                                </a>
                            </li>
                        @endif

                        @for($i = 1; $i <= ($pagination['last_page'] ?? 1); $i++)

                            @if(
                                $i == 1 ||
                                $i == ($pagination['last_page'] ?? 1) ||
                                abs($i - ($pagination['current_page'] ?? 1)) <= 2
                            )

                                <li class="{{ $i == ($pagination['current_page'] ?? 1) ? 'active' : '' }}">
                                    <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">
                                        {{ $i }}
                                    </a>
                                </li>

                            @elseif(
                                $i == (($pagination['current_page'] ?? 1) - 3) ||
                                $i == (($pagination['current_page'] ?? 1) + 3)
                            )

                                <li class="disabled">
                                    <span>...</span>
                                </li>

                            @endif

                        @endfor

                        @if(($pagination['current_page'] ?? 1) < ($pagination['last_page'] ?? 1))
                            <li>
                                <a href="{{ request()->fullUrlWithQuery([
                    'page' => $pagination['current_page'] + 1
                ]) }}">
                                    »
                                </a>
                            </li>
                        @endif

                    </ul>
                </div>
        </section>
    </div>
@endsection
