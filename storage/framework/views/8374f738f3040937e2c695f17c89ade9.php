

<?php $__env->startSection('content'); ?>

<!-- Main content -->
<section class="content py-4">
  <div class="container">
    <!-- Back Button -->
    <div class="mb-3">
      <a href="<?php echo e(url()->previous()); ?>" class="btn btn-outline-success btn-sm d-inline-flex align-items-center">
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

        <?php if($order): ?>
          <div class="row gy-4">
            <div class="col-md-6">
              <h5 class="fw-bold fs-4 mb-2">Order Number</h5>
              <p class="text-secondary mb-0 fs-5"><?php echo e($order->order_number ?? ''); ?></p>
            </div>

            <div class="col-md-6">
              <h5 class="fw-bold fs-4 mb-2">Order Date & Time</h5>
              <p class="text-secondary mb-0 fs-5"><?php echo e($order->updated_at ?? ''); ?></p>
            </div>

            <div class="col-md-6">
              <h5 class="fw-bold fs-4 mb-2">Customer Name</h5>
              <p class="text-secondary mb-0 fs-5">
                <?php echo e(ucwords(($order->first_name ?? '') . ' ' . ($order->last_name ?? ''))); ?>

              </p>
            </div>

            <div class="col-md-6">
              <h5 class="fw-bold fs-4 mb-2">Customer Email</h5>
              <p class="text-secondary mb-0 fs-5"><?php echo e($order->user->email ?? ''); ?></p>
            </div>
            
            <div class="col-md-6">
              <h5 class="fw-bold fs-4 mb-2">Customer Phone Number</h5>
              <p class="text-secondary mb-0 fs-5"><?php echo e($order->user->phone ?? ''); ?></p>
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
                <?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><a href="<?php echo e(route('product.view', $product['slug'])); ?>"><?php echo e($product['title'] ?? ''); ?></a></td>
                    <td><?php echo e($product['part_number'] ?? ''); ?></td>
                    <td><?php echo e($product['stock_quantity'] ?? ''); ?></td>
                    <td><?php echo e($product['sku'] ?? ''); ?></td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
          </div>

          <hr class="my-5">

          <div class="row gy-4">
            <div class="col-md-6">
              <h5 class="fw-bold fs-4 mb-2">Payment Method</h5>
              <p class="text-secondary mb-0 fs-5">
                <?php echo e($order->payment_method ? strtoupper($order->payment_method) : ''); ?>

              </p>
            </div>

            <div class="col-md-6">
              <h5 class="fw-bold fs-4 mb-2">Order Status</h5>
              <span class="badge bg-success fs-5 px-3 py-2">
                <?php echo e($order->status ? ucwords($order->status) : ''); ?>

              </span>
            </div>
          </div>

          <hr class="my-5">

          <div>
            <h5 class="fw-bold fs-4 mb-2">Shipping Address</h5>
            <p class="text-secondary mb-0 fs-5">
              <?php echo e($order->address_line_1 ? ucwords($order->address_line_1) . ', ' . ucwords($order->address_line_2) . ', ' . ucwords($order->city) . ', ' . ucwords($order->state) . ', ' . strtoupper($order->postal_code) . ', ' . strtoupper($order->country) : ''); ?>

            </p>
          </div>

          <div class="mt-5">
            <a href="<?php echo e(url()->previous()); ?>" class="btn btn-success btn-lg px-5">Back</a>
          </div>

        <?php else: ?>
          <p class="text-danger fs-5 mb-0">Order not found.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u770170027/domains/carpartslb.com/public_html/resources/views/admin/order/show.blade.php ENDPATH**/ ?>