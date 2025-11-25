<?php $__env->startSection('content'); ?>

    <!-- Main content -->
    <section class="content">
        <div class="row">
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

            <div class="col-xs-12">
                <?php $__currentLoopData = $carParts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $carPart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!-- Delete confirmation modal -->
                    <div class="modal fade" id="deleteModal<?php echo e($carPart->id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-danger" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Are you sure?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Do you want to delete this product?</p>
                                </div>
                                <div class="modal-footer modal-buttons">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <form action="<?php echo e(route('product.destroy', $carPart->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger" id="confirmDelete">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Delete confirmation modal -->
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                <!-- search form -->
                <div class="container-fluid" style="margin:0 0 10px 0;">
                    <div class="row">
                        <div class="col-10 col-sm-8 col-md-6 col-offset-1 col-sm-offset-2 col-md-offset-3">
                            <form action="<?php echo e(route('productSearch.admin')); ?>" method="GET" class="w-100">
                                <div class="input-group">
                                    <input type="text" name="q" class="form-control" value="<?php echo e($q ?? ''); ?>"
                                        placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="box">
                    <div class="main-flex">
                        <h3 class="box-title">All Product</h3>
                        <a href="<?php echo e(route('product.create')); ?>" class="btn btn-primary btn-sm">Add New Product</a>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <form action="<?php echo e(route('product.deleteSelected')); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                            <button type="submit" class="btn btn-danger" style="margin-bottom:10px;">Delete
                                Selected</button>

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="account__table--header__child--items" style="width:60px;">
                                            <input type="checkbox" id="selectAll"> All
                                        </th>
                                        <th>Sr #</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Stock</th>
                                        <th>Part Brand</th>
                                        <th>Part Number</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($carParts->count() > 0): ?>
                                        <?php $__currentLoopData = $carParts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $carPart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="ids[]" value="<?php echo e($carPart->id); ?>"
                                                        class="checkbox">
                                                </td>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><img src="<?php echo e($carPart->feature_image ? asset('public/images/parts/feature/' . $carPart->feature_image) : asset('public/images/brands/demo.png')); ?>"
                                                        alt="<?php echo e($carPart->feature_image); ?>" class="table-brand-image"></td>
                                                <td><a href="#" class="all-title"><?php echo e($carPart->title); ?></a></td>
                                                <td><?php echo e($carPart->part_type_id ? $carPart->carPartType->title : 'None'); ?></td>
                                                <td><?php echo e($carPart->stock_type == 'in' ? 'In Stock' : 'Out of Stock'); ?></td>
                                                <td><?php echo e($carPart->part_brand_id ? $carPart->carPartBrand->title : 'None'); ?></td>
                                                <td><?php echo e($carPart->part_number ?? 'None'); ?>

                                                </td>
                                                <td>
                                                    <div class="action-container">
                                                        <a href="<?php echo e(route('product.edit', $carPart->id)); ?>"
                                                            class="edit-icon"><i class="fa fa-edit"></i></a>
                                                        <span class="delete-icon fa fa-trash-o" data-toggle="modal" data-target="#deleteModal<?php echo e($carPart->id); ?>" data-id="<?php echo e($carPart->id); ?>"><i></i></span>
                                                        <a href="<?php echo e(route('product.view', $carPart->slug)); ?>"
                                                            class="view-icon"><i class="fa fa-eye"></i></a>
                                                    </div>
                                                </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="9" class="text-center">No products found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                                
                            </table>
                        </form>
                        <!-- Pagination Links -->
                        <?php echo e($carParts->links('pagination::bootstrap-4')); ?>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const selectAll = document.getElementById("selectAll");
                const checkboxes = document.querySelectorAll(".checkbox");

                selectAll.addEventListener("change", function() {
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = selectAll.checked;
                    });
                });

                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener("change", function() {
                        if (!this.checked) {
                            selectAll.checked = false;
                        } else if (document.querySelectorAll(".checkbox:checked").length === checkboxes
                            .length) {
                            selectAll.checked = true;
                        }
                    });
                });
            });
        </script>

    </section><!-- /.content -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\sajjel\laragon\www\carpartslb.com\resources\views/admin/product/index.blade.php ENDPATH**/ ?>