

<?php $__env->startSection('content'); ?>
<section class="container-fluid" style="height:80vh; display:flex; justify-content:center; align-items:center;">
    <div class="text-center">
        <h1 style="font-size:60px;">404 Error</h1>
        <p>Page not found</p>
        <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-success">Back to dashboard</a>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u770170027/domains/carpartslb.com/public_html/resources/views/admin/errors/404.blade.php ENDPATH**/ ?>