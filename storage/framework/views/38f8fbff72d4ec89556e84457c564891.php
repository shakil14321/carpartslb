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

        <!-- Home slider images -->
        <div class="container">
            <div class="row">
                
            <div class="col-12">
                <p class="text-danger"><strong>Note:</strong> Always upload the slider image transparant background.</p>
            </div>
                
                <!-- Home slide first image -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="form-group">
                    <label for="imageFile">Home Slider 1st Image</label>
                    <input type="file" id="imageFile" name="carousel_image_one">
                    <br>
                    <img src="<?php echo e($setting && $setting->carousel_image_one ? asset('public/images/banners/' . $setting->carousel_image_one) : asset('public/assets/front/img/slider/home-slider1-layer.png') ); ?>"
                        alt="" class="edit-add-image" id="brandImagePreview">
                </div>
            </div>
            
            <!-- Home slide second image -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="form-group">
                    <label for="imageFile">Home Slider 2nd Image</label>
                    <input type="file" id="imageFile" name="carousel_image_two">
                    <br>
                    <img src="<?php echo e($setting && $setting->carousel_image_two ? asset('public/images/banners/' . $setting->carousel_image_two) : asset('public/assets/front/img/slider/home-slider2-layer.png') ); ?>"
                        alt="" class="edit-add-image" id="brandImagePreview">
                </div>
            </div>
            
            <!-- Home slide third image -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="form-group">
                    <label for="imageFile">Home Slider 3rd Image</label>
                    <input type="file" id="imageFile" name="carousel_image_three">
                    <br>
                    <img src="<?php echo e($setting && $setting->carousel_image_three ? asset('public/images/banners/' . $setting->carousel_image_three) : asset('public/assets/front/img/slider/home-slider4-layer.png') ); ?>"
                        alt="" class="edit-add-image" id="brandImagePreview">
                </div>
            </div>
        </div>
        </div>

        <button type="submit" class="btn btn-success">Save Settings</button>
    </form>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\sajjel\laragon\www\carpartslb.com\resources\views/admin/siteSetting/homeSlider.blade.php ENDPATH**/ ?>