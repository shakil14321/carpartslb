@extends('layouts.front.front-layout')

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible notic_bar" style="margin:20px;">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible notic_bar" style="margin:20px;">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ session('error') }}
        </div>
    @endif

    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content text-center">
                        <ul class="breadcrumb__content--menu d-flex justify-content-center">
                            <li class="breadcrumb__content--menu__items"><a
                                    href="{{ route('customerDashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb__content--menu__items"><span>Order Details</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->

    <!-- my account section start -->
    <section class="my__account--section section--padding" style="background-color: #f8f9fa;">
        <div class="container">
            <p class="account__welcome--text fs-5 mb-4">
                👋 Hello, <strong>{{ Auth::user()->name }}</strong> — welcome to your dashboard!
            </p>

            <div class="my__account--section__inner border-radius-10 p-4 bg-white shadow-sm">
                @if ($order)
                    <div class="container">

                        <!-- Back Button -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <a href="{{ route('customerDashboard') }}"
                                    class="text-decoration-none text-danger d-inline-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none"
                                        stroke="#ed1d24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="me-1">
                                        <path d="M6 8L2 12L6 16" />
                                        <path d="M2 12H22" />
                                    </svg>
                                    <span>Back to Dashboard</span>
                                </a>
                            </div>
                        </div>

                        <!-- Section Heading -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h2 class="border-bottom pb-2 text-success fw-bold">🛒 Order Details</h2>
                            </div>
                        </div>

                        <!-- Order Info -->
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <h5 class="fw-semibold mb-1">Order Number</h5>
                                <p class="text-secondary fs-5 mb-0">{{ $order->order_number ?? '' }}</p>
                            </div>

                            <div class="col-md-6">
                                <h5 class="fw-semibold mb-1">Order Date & Time</h5>
                                <p class="text-secondary fs-5 mb-0">{{ $order->updated_at ?? '' }}</p>
                            </div>

                            <div class="col-md-6">
                                <h5 class="fw-semibold mb-1">Customer Name</h5>
                                <p class="text-secondary fs-5 mb-0">
                                    {{ ucwords(($order->first_name ?? '') . ' ' . ($order->last_name ?? '')) }}
                                </p>
                            </div>

                            <div class="col-md-6">
                                <h5 class="fw-semibold mb-1">Customer Email</h5>
                                <p class="text-secondary fs-5 mb-0">{{ $order->user->email ?? '' }}</p>
                            </div>
                        </div>

                        <!-- Products Table -->
                        <div class="mt-5">
                            <h4 class="fw-bold mb-3 text-success">Products</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle text-center shadow-sm">
                                    <thead class="table-success">
                                        <tr>
                                            <th>Sr. #</th>
                                            <th>Product Name</th>
                                            <th>Part Number</th>
                                            <th>Quantity</th>
                                            <th>SKU</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->products as $product)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $product['title'] ?? '' }}</td>
                                                <td>{{ $product['part_number'] ?? '' }}</td>
                                                <td>{{ $product['quantity'] ?? '' }}</td>
                                                <td>{{ $product['sku'] ?? '' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Payment & Status -->
                        <div class="row gy-4 mt-5">
                            <div class="col-md-6">
                                <h5 class="fw-semibold mb-1">Payment Method</h5>
                                <p class="text-secondary fs-5 mb-0">
                                    {{ $order->payment_method ? strtoupper($order->payment_method) : '' }}
                                </p>
                            </div>

                            <div class="col-md-6">
                                <h5 class="fw-semibold mb-1">Order Status</h5>
                                <span class="badge bg-success fs-6 px-3 py-2">
                                    {{ $order->status ? ucwords($order->status) : '' }}
                                </span>
                            </div>
                        </div>

                        <!-- Shipping -->
                        <div class="mt-5">
                            <h5 class="fw-semibold mb-1">Shipping Address</h5>
                            <p class="text-secondary fs-5 mb-0">
                                {{ $order->address_line_1 ? ucwords($order->address_line_1) . ', ' . ucwords($order->address_line_2) . ', ' . ucwords($order->city) . ', ' . ucwords($order->state) . ', ' . strtoupper($order->postal_code) . ', ' . strtoupper($order->country) : '' }}
                            </p>
                        </div>

                        <!-- Back Button -->
                        <div class="row mt-4">
                            <div class="col-3">
                                <a href="{{ route('customerDashboard') }}"
                                    class="account__login--btn primary__btn text-center">Back</a>
                            </div>

                            @if ($order->status !== 'cancel' && $order->status === 'review')
                                <div class="col-3">
                                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" value="cancel" name="status" />
                                        <button type="submit" class="account__login--btn primary__btn text-center">Cancel
                                            Order</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <p class="text-danger fs-5">Order not found.</p>
                @endif
            </div>
        </div>
    </section>
    <!-- my account section end -->


    @include('front.partials.shipping_sec')
@endsection
