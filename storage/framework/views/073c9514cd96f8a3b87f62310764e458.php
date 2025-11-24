

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

        <!-- Dynamic Menu Items -->
        <div id="menu-container">
            <label>Menu Items</label>
            <?php if(!empty($setting->menu_items)): ?>
                <?php $__currentLoopData = $setting->menu_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row menu-item mb-2">
                        <div class="col-md-5">
                            <input type="text" name="menu_name[]" class="form-control" value="<?php echo e($item['name']); ?>" placeholder="Menu Name">
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="menu_link[]" class="form-control" value="<?php echo e($item['link']); ?>" placeholder="Menu Link">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove-menu">X</button>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>

        <button type="button" class="btn btn-primary" id="add-menu">+ Add Menu Item</button><br><br>

        <button type="submit" class="btn btn-success">Save Settings</button>
    </form>
</section>

<script>
document.getElementById('add-menu').addEventListener('click', function() {
    const div = document.createElement('div');
    div.classList.add('menu-item', 'row', 'mb-2');
    div.innerHTML = `
        <div class="col-md-5">
            <input type="text" name="menu_name[]" class="form-control" placeholder="Menu Name">
        </div>
        <div class="col-md-5">
            <input type="text" name="menu_link[]" class="form-control" placeholder="Menu Link">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-danger remove-menu">X</button>
        </div>
    `;
    document.getElementById('menu-container').appendChild(div);
});

document.addEventListener('click', function(e){
    if(e.target && e.target.classList.contains('remove-menu')){
        e.target.closest('.menu-item').remove();
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u770170027/domains/carpartslb.com/public_html/resources/views/admin/siteSetting/menu.blade.php ENDPATH**/ ?>