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

                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!-- Delete confirmation modal -->
                    <div class="modal fade" id="deleteModal<?php echo e($user->id); ?>" tabindex="-1" role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog modal-danger" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Are you sure?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Do you want to delete this user?</p>
                                </div>
                                <div class="modal-footer modal-buttons">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <form action="<?php echo e(route('user.destroy', $user->id)); ?>" method="POST">
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


                <div class="box">
                    <div class="main-flex">
                        <h3 class="box-title">All Users</h3>
                        <a href="<?php echo e(route('user.create')); ?>" class="btn btn-primary btn-sm">Add New User</a>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <form action="<?php echo e(route('user.deleteSelected')); ?>" method="POST">
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
                                        <th>User Image</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Verified</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($users->count() > 0): ?>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="ids[]" value="<?php echo e($user->id); ?>"
                                                        class="checkbox">
                                                </td>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><img src="<?php echo e($user->user_image ? asset('public/images/users/' . $user->user_image) : asset('public/images/brands/demo.png')); ?>"
                                                        alt="<?php echo e($user->user_image); ?>" class="table-brand-image"></td>
                                                <td><a href="#" class="all-title"><?php echo e($user->name ?? ''); ?></a></td>
                                                <td><a href="#" class="all-email"><?php echo e($user->email ?? ''); ?></a></td>
                                                <td><a href="#" class="all-email"><?php echo e($user->phone ?? ''); ?></a></td>
                                                <td><?php echo e(ucwords($user->role ?? '')); ?></td>
                                                <td>
                                                    <p
                                                        class="verificaton_btn <?php echo e(!is_null($user->email_verified_at) ? 'text-success' : 'text-danger'); ?>">
                                                        <?php echo e(!is_null($user->email_verified_at) ? 'Done' : 'None'); ?></p>
                                                </td>
                                                <td>
                                                    <div class="action-container">
                                                        <a href="<?php echo e(route('user.edit', $user->id)); ?>" class="edit-icon"><i
                                                                class="fa fa-edit"></i></a>
                                                        <a href="javascript:void(0)">
                                                            <span class="delete-icon fa fa-trash-o" data-toggle="modal"
                                                                data-target="#deleteModal<?php echo e($user->id); ?>"
                                                                data-id="<?php echo e($user->id); ?>"><i></i></span>
                                                        </a>
                                                        
                                                    </div>
                                                </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center">No users found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                        </form>
                        <!-- Pagination Links -->
                        <?php echo e($users->links('pagination::bootstrap-4')); ?>

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

<?php echo $__env->make('layouts.admin.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\sajjel\laragon\www\carpartslb.com\resources\views/admin/user/index.blade.php ENDPATH**/ ?>