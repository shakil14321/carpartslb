<?php $__env->startSection('content'); ?>
<section class="content container-fluid">
    <h2>Site Settings</h2>
    <p>How much car brand do you want to show on home page?</p>

    <!-- Alert messages -->
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible" style="margin:20px;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible" style="margin:20px;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('site.setting.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <!-- Logo -->
        <div class="form-group">
            <label for="brandQuantity">Brand Quantity</label>
            <input type="number" id="brandQuantity" name="brand_quantity" value="<?php echo e($setting->brand_quantity); ?>" class="form-control" placeholder="Enter brand quantity">
        </div>

        <button type="submit" class="btn btn-success">Save Settings</button>
    </form>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\sajjel\laragon\www\carpartslb.com\resources\views/admin/siteSetting/brand.blade.php ENDPATH**/ ?>