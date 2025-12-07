@extends('layouts.admin.admin-layout')

@section('content')
    <style>
        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        @media print {

            .btn,
            .btn-sm,
            nav,
            header,
            footer {
                display: none !important;
            }

            .card {
                border: none !important;
                box-shadow: none !important;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>

    <!-- Main content -->

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
    <section class="content py-4">
        <div class="container">
            <!-- Back Button -->
            <div class="mb-3 header-actions">
                <a href="{{ route('orderView.admin') }}"
                    class="btn btn-outline-success btn-sm d-inline-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="me-1">
                        <path d="M6 8L2 12L6 16" />
                        <path d="M2 12H22" />
                    </svg>
                    Back
                </a>

                <button onclick="window.print()" class="btn btn-primary btn-sm d-inline-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="me-1">
                        <path d="M6 9V2h12v7" />
                        <path d="M6 14H4a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-2" />
                        <path d="M6 18h12v-6H6v6z" />
                    </svg>
                    Print
                </button>
            </div>


            <div class="card shadow-sm border-0">
                <div class="card-body px-4 py-5">
                    <h2 class="card-title border-bottom pb-3 mb-4 text-success fw-bold fs-4" style="font-size: 1.8rem;">
                        Order Details
                    </h2>

                    @if ($order)
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <h5 class="fw-bold fs-4 mb-2">Order Number</h5>
                                <p class="text-secondary mb-0 fs-5">{{ $order->order_number ?? '' }}</p>
                            </div>

                            <div class="col-md-6">
                                <h5 class="fw-bold fs-4 mb-2">Order Date & Time</h5>
                                <p class="text-secondary mb-0 fs-5">{{ $order->updated_at ?? '' }}</p>
                            </div>

                            <div class="col-md-6">
                                <h5 class="fw-bold fs-4 mb-2">Customer Name</h5>
                                <p class="text-secondary mb-0 fs-5">
                                    {{ ucwords(($order->first_name ?? '') . ' ' . ($order->last_name ?? '')) }}
                                </p>
                            </div>

                            <div class="col-md-6">
                                <h5 class="fw-bold fs-4 mb-2">Customer Email</h5>
                                <p class="text-secondary mb-0 fs-5">{{ $order->user->email ?? '' }}</p>
                            </div>

                            <div class="col-md-6">
                                <h5 class="fw-bold fs-4 mb-2">Customer Phone Number</h5>
                                <p class="text-secondary mb-0 fs-5">{{ $order->user->phone ?? '' }}</p>
                            </div>
                        </div>

                        <hr class="my-5">

                        <h4 class="fw-bold fs-4 mb-3 text-success">Products</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle text-center">
                                <thead class="table-success">
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Sr. #</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Part Number</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">SKU</th>
                                        <th scope="col">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->products as $product)
                                        @php
                                            $canCancelItem = in_array($order->status, ['pending', 'process', 'review']);
                                        @endphp
                                        <tr>
                                            <td>
                                                @if ($canCancelItem)
                                                    <form action="{{ route('order.cancelItem') }}" method="POST"
                                                        style="display:inline-block;">
                                                        @csrf
                                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                        <input type="hidden" name="sku" value="{{ $product['sku'] }}">
                                                        <button type="submit" class="btn btn-outline-danger btn-sm p-1"
                                                            title="Cancel Item">
                                                            <!-- Trash / cancel icon SVG -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-x-circle"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
                                                                <path
                                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1
                                                                                                                                .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8
                                                                                                                                4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a
                                                    href="{{ route('product.view', $product['slug']) }}">{{ $product['title'] ?? '' }}</a>
                                            </td>
                                            <td>{{ $product['part_number'] ?? '' }}</td>
                                            <td>{{ $product['quantity'] ?? '' }}</td>
                                            <td>{{ $product['sku'] ?? '' }}</td>
                                            <td>${{ number_format($product['sale_price'], 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="6" class="text-end">Order Total</th>
                                        <th>{{ $order->total }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <hr class="my-5">

                        <div class="row gy-4">
                            <div class="col-md-6">
                                <h5 class="fw-bold fs-4 mb-2">Payment Method</h5>
                                <p class="text-secondary mb-0 fs-5">
                                    {{ $order->payment_method ? strtoupper($order->payment_method) : '' }}
                                </p>
                            </div>

                            <div class="col-md-6">
                                <h5 class="fw-bold fs-4 mb-2">Order Status</h5>
                                <span class="badge bg-success fs-5 px-3 py-2">
                                    {{ $order->status ? ucwords($order->status) : '' }}
                                </span>
                            </div>
                        </div>

                        <hr class="my-5">

                        <div>
                            <h5 class="fw-bold fs-4 mb-2">Shipping Address</h5>
                            <p class="text-secondary mb-0 fs-5">
                                {{ $order->address_line_1 ? ucwords($order->address_line_1) . ', ' . ucwords($order->address_line_2) . ', ' . ucwords($order->city) . ', ' . ucwords($order->state) . ', ' . strtoupper($order->postal_code) . ', ' . strtoupper($order->country) : '' }}
                            </p>
                        </div>

                        <div class="mt-5">
                            <a href="{{ route('orderView.admin') }}" class="btn btn-success btn-lg px-5">Back</a>
                        </div>
                    @else
                        <p class="text-danger fs-5 mb-0">Order not found.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection
