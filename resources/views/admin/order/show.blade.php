@extends('layouts.admin.admin-layout')

@section('content')

<!-- Main content -->
<section class="content py-4">
  <div class="container">
    <!-- Back Button -->
    <div class="mb-3">
      <a href="{{ url()->previous() }}" class="btn btn-outline-success btn-sm d-inline-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor"
          stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
          <path d="M6 8L2 12L6 16" />
          <path d="M2 12H22" />
        </svg>
        Back
      </a>
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
                  <th scope="col">Sr. #</th>
                  <th scope="col">Product Name</th>
                  <th scope="col">Part Number</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">SKU</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($order->products as $product)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><a href="{{ route('product.view', $product['slug'])}}">{{ $product['title'] ?? '' }}</a></td>
                    <td>{{ $product['part_number'] ?? '' }}</td>
                    <td>{{ $product['stock_quantity'] ?? '' }}</td>
                    <td>{{ $product['sku'] ?? '' }}</td>
                  </tr>
                @endforeach
              </tbody>
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
            <a href="{{ url()->previous() }}" class="btn btn-success btn-lg px-5">Back</a>
          </div>

        @else
          <p class="text-danger fs-5 mb-0">Order not found.</p>
        @endif
      </div>
    </div>
  </div>
</section>

@endsection
