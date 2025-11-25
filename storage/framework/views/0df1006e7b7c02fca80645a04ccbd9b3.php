<?php $__env->startSection('content'); ?>
<section class="content container-fluid">
    <h2>Site Settings</h2>

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
            <label for="imageFile">Logo Image</label>
            <input type="file" id="imageFile" name="site_logo">
            <br>
            <img src="<?php echo e($setting && $setting->site_logo ? asset('public/images/logos/' . $setting->site_logo) : asset('public/images/brands/demo.png') ); ?>"
                alt="" class="edit-add-image" id="brandImagePreview" style="width:300px !important;">
        </div>

        <button type="submit" class="btn btn-success">Save Settings</button>
    </form>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\sajjel\laragon\www\carpartslb.com\resources\views/admin/siteSetting/logo.blade.php ENDPATH**/ ?>