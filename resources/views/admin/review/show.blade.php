@extends('layouts.admin.admin-layout')

@section('content')
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
      <div class="card-body p-4">

        <h4 class="card-title border-bottom pb-3 mb-4 text-success fw-bold">
          Review Details
        </h4>

        @if ($review)
          <div class="row g-4 align-items-center">

            <!-- User Image -->
            <div class="col-md-3 text-center">
              <img src="{{ $review->user_image ? asset('public/images/users/' . $review->user_image) : asset('public/images/users/user.png') }}"
                   alt="{{ $review->username }}" 
                   class="img-fluid rounded-circle shadow-sm"
                   style="width:130px; height:130px; object-fit:cover;">
            </div>

            <!-- Review Info -->
            <div class="col-md-9">
              <div class="table-responsive">
                <table class="table table-bordered mb-0">
                  <tbody>
                    <tr>
                      <th style="width: 180px;">Username</th>
                      <td>{{ ucwords($review->username ?? 'N/A') }}</td>
                    </tr>
                    <tr>
                      <th>Email</th>
                      <td>{{ $review->email ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                      <th>Rating</th>
                      <td>
                        @for ($i = 1; $i <= 5; $i++)
                          <i class="fa fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                        @endfor
                        <span class="ms-2">({{ $review->rating ?? 0 }}/5)</span>
                      </td>
                    </tr>
                    <tr>
                      <th>Product</th>
                      <td>
                        <a href="{{ $review->product_url ?? '#' }}" target="_blank">
                          {{ ucwords($review->product_title ?? 'N/A') }}
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <th>Review Message</th>
                      <td class="text-secondary">
                        {{ $review->review ?? 'No review text provided.' }}
                      </td>
                    </tr>
                    <tr>
                      <th>Date</th>
                      <td>Created: {{ $review->created_at ? $review->created_at->format('d M Y, h:i A') : 'N/A' }}, Updated: {{ $review->created_at ? $review->updated_at->format('d M Y, h:i A') : 'N/A' }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        @else
          <p class="text-danger fs-5 mb-0">Review not found.</p>
        @endif

      </div>
    </div>
  </div>
</section>
@endsection
