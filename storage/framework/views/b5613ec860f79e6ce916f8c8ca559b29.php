

<?php $__env->startSection('content'); ?>
<section class="content container-fluid">
    <h2>Site Settings</h2>
    <p>Enter mark google verification code.</p>
    <div class="guide-box" style="margin:0 0 10px 0;">
        <code>
            &lt;meta name="google-site-verification" content="<mark class="bg-success">AbCdEfGhIjKlMnOpQrStUvWxYz1234567890</mark>" /&gt;
        </code>
    </div>


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
            <label for="googleVerification">Google Site Verification</label>
            <input type="text" id="googleVerification" name="google_verification" value="<?php echo e($setting->google_verification ?? ''); ?>" class="form-control" placeholder="AbCdEfGhIjKlMnOpQrStUvWxYz1234567890">
        </div>

        <button type="submit" class="btn btn-success">Save Settings</button>
    </form>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u770170027/domains/carpartslb.com/public_html/resources/views/admin/siteSetting/site_verification.blade.php ENDPATH**/ ?>