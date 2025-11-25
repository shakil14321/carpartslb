<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content">
     <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible notic_bar" style="margin:20px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible notic_bar" style="margin:20px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>
    <!-- Stat box first -->
    <div class="row">
        
        <!--Total Orders-->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?php echo e($orders ?? ''); ?></h3>
                    <p>All Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="<?php echo e(route('orderView.admin')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        
        <!-- New orders -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo e($reviewOrders ?? ''); ?></h3>
                    <p>New Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-ionic-outline"></i>
                </div>
                <a href="<?php echo e(route('reviewOrder.admin')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        
        <!-- Total processing orders -->
        <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3>
                    <?php echo e($processOrders ?? ''); ?>

                  </h3>
                  <p>
                    Process Orders
                  </p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-refresh-outline"></i>
                </div>
                <a href="<?php echo e(route('processOrder.admin')); ?>" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            
        <!--Total delivered orders  -->
        <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-teal">
                <div class="inner">
                  <h3>
                    <?php echo e($deliverOrders ?? ''); ?>

                  </h3>
                  <p>
                    Deliver orders
                  </p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-redo-outline"></i>
                </div>
                <a href="<?php echo e(route('deliverOrder.admin')); ?>" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
        
    </div><!-- /.row -->
    
    <!-- Stat box second -->
    <div class="row">
        
        <!-- Completed orders -->
        <div class="col-lg-3 col-xs-6">
             <!-- small box -->
             <div class="small-box bg-blue">
                <div class="inner">
                  <h3>
                    <?php echo e($completedOrders ?? ''); ?>

                  </h3>
                  <p>
                    Completed Orders
                  </p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-cart-outline"></i>
                </div>
                <a href="<?php echo e(route('completeOrder.admin')); ?>" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
        </div><!-- ./col -->
        
        <!-- cancel orders -->
        <div class="col-lg-3 col-xs-6">
             <!-- small box -->
             <div class="small-box bg-red">
                <div class="inner">
                  <h3>
                    <?php echo e($canceldOrders ?? ''); ?>

                  </h3>
                  <p>
                    Cancel Orders
                  </p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-cart-outline"></i>
                </div>
                <a href="<?php echo e(route('cancelOrders.admin')); ?>" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
        </div><!-- ./col -->
        
        <!--Total Sale-->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3><?php echo e($totalRevenue .'$' ?? ''); ?></h3>
                    <p>Total Sale</p>
                </div>
                <div class="icon">
                    <i class="fa fa-signal"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        
        <!--Total Customers Register-->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?php echo e($totalCustomers ?? ''); ?></h3>
                    <p>Customer Registrations</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="<?php echo e(route('cutomers.view')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        
        
    </div>
    
    <!-- Stat box third -->
    <div class="row">
        
        <!-- Total products -->
        <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-maroon">
                <div class="inner">
                  <h3>
                    <?php echo e($products ?? ''); ?>

                  </h3>
                  <p>
                    Products
                  </p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-pricetag-outline"></i>
                </div>
                <a href="<?php echo e(route('product.index')); ?>" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
        
        <!--Total reviews-->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-purple">
                <div class="inner">
                    <h3><?php echo e($reviews ?? ''); ?></h3>
                    <p>Total Reviews</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-chatbubble-outline"></i>
                </div>
                <a href="<?php echo e(route('review.index')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        
    </div>
    
</section><!-- /.content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\sajjel\laragon\www\carpartslb.com\resources\views/admin/dashboard/index.blade.php ENDPATH**/ ?>