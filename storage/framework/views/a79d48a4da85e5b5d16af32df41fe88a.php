<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger main-danger notic_bar">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <div class="main-flex">
                        <h3 class="box-title">Edit User</h3>
                        <a href="<?php echo e(route('user.index')); ?>" class="btn btn-primary btn-sm">All Users</a>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?php echo e(route('user.update', $user->id)); ?>" method="POST"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="box-body">
                            
                            <div class="form-group">
                                <label for="input-title">Username</label>
                                <input type="text" class="form-control brand-name" id="input-title"
                                    placeholder="Enter username" name="name" value="<?php echo e(old('name', $user->name)); ?>">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first-name">First Name</label>
                                        <input type="text" class="form-control brand-name" id="first-name"
                                            placeholder="Enter first name" name="first_name"
                                            value="<?php echo e(old('first_name', $user->first_name)); ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last-name">Last Name</label>
                                        <input type="text" class="form-control brand-name" id="last-name"
                                            placeholder="Enter last name" name="last_name" value="<?php echo e(old('last_name', $user->last_name)); ?>">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    
                                    <div class="form-group">
                                        <label for="input-title">Email</label>
                                        <input type="email" class="form-control brand-name" id="input-title"
                                            placeholder="Enter email" name="email" value="<?php echo e(old('email', $user->email)); ?>">
                                    </div>
                                </div>
                                

                                <div class="col-md-6">
                                    
                                    <div class="form-group">
                                        <label for="input-title">Phone</label>
                                        <input type="tel" class="form-control brand-name" id="input-title"
                                            placeholder="Enter phone" name="phone" value="<?php echo e(old('phone', $user->phone)); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="user-role">Choose Role</label>
                                <select class="form-control" name="role" id="user-role">
                                   <?php if($user->role == 'admin'): ?>
                                   <option selected disabled>Choose one Type</option>
                                    <option value="admin" <?php echo e($user->role == 'admin' ? 'selected' : ''); ?>>Admin</option>
                                    <option value="author" <?php echo e($user->role == 'author' ? 'selected' : ''); ?>>Author</option>
                                    <option value="customer" <?php echo e($user->role == 'customer' ? 'selected' : ''); ?>>Customer</option>
                                   <?php else: ?>
                                    <option value="author" <?php echo e($user->role == 'author' ? 'selected' : ''); ?>>Author</option>
                                   <?php endif; ?>
                                    
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="imageFile">User Image (Optional)</label>
                                <input type="file" id="imageFile" name="user_image">
                                <br>
                                <img src="<?php echo e(old('user_image', $user->user_image) ? asset('public/images/users/' . old('user_image', $user->user_image)) : asset('public/images/brands/demo.png')); ?>"
                                    alt="" class="edit-add-image" id="brandImagePreview">
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div> <!-- /.row -->
    </section><!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u770170027/domains/carpartslb.com/public_html/resources/views/admin/user/edit.blade.php ENDPATH**/ ?>