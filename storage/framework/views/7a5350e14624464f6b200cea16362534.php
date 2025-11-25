<?php $__env->startSection('content'); ?>

<section class="content container-fluid">
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
    
<!-- Delete confirmation modal -->
<?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $fileName = basename($img);
        $modalId = 'deleteModal_' . md5($fileName);
    ?>

    <!-- Modal -->
    <div class="modal fade" id="<?php echo e($modalId); ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-danger" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you want to delete this image?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                    <form action="<?php echo e(route('brandImage.deleteSingle')); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <input type="hidden" name="id" value="<?php echo e($fileName); ?>" class=""/>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<!-- Upload image Modal -->
<div class="modal fade" id="uploadFeatureImageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Product image gallery Input -->
        <div class="form-group">
            
            <!-- Submite images -->
            <form action="<?php echo e(route('brand.upload')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <label for="imageGalleryFile">Upload Feature Images</label>
                <input type="file" id="imageGalleryFile" name="multi_images[]" multiple accept="image/*">
                
                
            
        
            <!-- Preview container -->
            <div id="galleryPreview">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Insert Images</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- End upload image Modal -->



    <h2 style="padding:0 20px 10px 20px">Brand Images</h2>

    <!-- MULTI DELETE FORM -->
    <form action="<?php echo e(route('brandImage.deleteSelected')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>

        <div class="select_action">
            <div>
                <button type="submit" class="btn btn-danger mb-3 mr-3">Delete Selected</button>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#uploadFeatureImageModal">Upload Image</button>
            </div>
            <div>
                <input type="checkbox" id="selectAll"> Select All
            </div>    
        </div>

        <div class="feature_image_wrap">
            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $fileName = basename($img);
                    $modalId = 'deleteModal_' . md5($fileName);
                ?>
                <div class="feature_image_item">
                    <img src="<?php echo e(asset($img)); ?>" alt="Feature Image" width="150px" class="img-thumbnail">
                    <div class="feature_image_overlay">
                        <input type="checkbox" name="ids[]" value="<?php echo e($fileName); ?>" class="feature_image_checkbox checkbox"/>
                        <span class="delete-icon" data-toggle="modal" data-target="#<?php echo e($modalId); ?>">
                            <i class="fa fa-trash-o feature_delete_icon"></i>
                        </span>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </form>

    <div style="margin-top:20px;">
        <?php echo e($images->links()); ?>

    </div>
</section>

<!-- Checkbox style JS -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ✅ Single checkbox change effect (highlight image)
    document.querySelectorAll('.feature_image_checkbox').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const parent = this.closest('.feature_image_item');
            if (this.checked) {
                parent.classList.add('checked');
            } else {
                parent.classList.remove('checked');
            }
        });
    });

    // ✅ Select All functionality
    const selectAll = document.getElementById("selectAll");
    const checkboxes = document.querySelectorAll(".feature_image_checkbox");

    if (selectAll) {
        selectAll.addEventListener("change", function () {
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;

                // 👇 When "Select All" is checked, show + highlight all images
                const parent = checkbox.closest('.feature_image_item');
                if (selectAll.checked) {
                    parent.classList.add('checked');
                    parent.classList.add('show-checkbox'); // force show checkbox
                } else {
                    parent.classList.remove('checked');
                    parent.classList.remove('show-checkbox');
                }
            });
        });

        // ✅ Sync Select All checkbox if user manually unchecks
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("change", function () {
                const allChecked = document.querySelectorAll(".feature_image_checkbox:checked").length === checkboxes.length;
                selectAll.checked = allChecked;
            });
        });
    }

});
</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\sajjel\laragon\www\carpartslb.com\resources\views/admin/media/brand.blade.php ENDPATH**/ ?>