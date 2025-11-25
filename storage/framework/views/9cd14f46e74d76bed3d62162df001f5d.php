<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-cloud-upload"></i>
                <h3 class="box-title">Import Products</h3>

                <?php if(session('failures')): ?>
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Import Errors:</strong>
                    <ul>
                        <?php $__currentLoopData = session('failures'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $failure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>Row <?php echo e($failure->row()); ?>: <?php echo e(implode(', ', $failure->errors())); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endif; ?>

                <?php if(session('success')): ?>
                <div class="alert alert-success" style="margin:20px;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo e(session('success')); ?>

                </div>
                <?php endif; ?>
            </div>
            <div class="box-body pad table-responsive">
                <p>Click here to export excel sheet template</p>
                <div >
                    <a href="<?php echo e(route('export')); ?>" class="btn btn-primary">Excel Sheet Template</a>
                </div>
            </div>
            <div class="box-body pad table-responsive">
                <p>Click here to import the products by excel sheet</p>
                <div>
                    <form action="<?php echo e(route('import')); ?>" method="POST" enctype="multipart/form-data"
                        style="display:inline-block;">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="excelFile">Import Excel File</label>
                            <input type="file" name="file" id="excelFile" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Import Excel</button>
                    </form>
                </div>
            </div><!-- /.box -->
        </div>
    </div><!-- /.col -->
</div><!-- ./row -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\sajjel\laragon\www\carpartslb.com\resources\views/admin/exp_imp/import_products.blade.php ENDPATH**/ ?>