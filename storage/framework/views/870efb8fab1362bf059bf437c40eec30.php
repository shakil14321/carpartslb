<?php $__env->startSection('content'); ?>
    <!-- Start registration section  -->
    <div class="login__section section--padding">
        <div class="container">
            <form action="<?php echo e(route('register')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="login__section--inner">
                    <div class="row row-cols-md-2 row-cols-1 d-flex justify-content-center align-items-center">
                        <div class="col">
                            <div class="account__login register">
                                <div class="account__login--header mb-25">
                                    <h2 class="account__login--header__title mb-10">Create an Account</h2>
                                       <?php if($errors->any()): ?>
                                            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 main-danger notic_bar" role="alert"
                                                style="margin:20px; border-radius:8px;">
                                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                                <strong>Whoops! Something went wrong:</strong>
                                                <ul class="mt-2 mb-0 ps-3">
                                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li><?php echo e($error); ?></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        <?php endif; ?>
                                    
                                    
                                    
                                        <?php if(session('success')): ?>
                                            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 notic_bar" role="alert"
                                                style="margin:20px; border-radius:8px;">
                                                <i class="bi bi-check-circle-fill me-2"></i>
                                                <?php echo e(session('success')); ?>

                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        <?php endif; ?>
                                    <p class="account__login--header__desc">Register here if you are a new customer
                                    </p>
                                </div>
                                <div class="account__login--inner">
                                    <div class="row">
                                        <label class="col-12 col-md-6">
                                            <input class="account__login--input" placeholder="First Name" type="text"
                                                value="<?php echo e(old('first_name')); ?>" name="first_name">
                                        </label>

                                        <label class="col-12 col-md-6">
                                            <input class="account__login--input" placeholder="Last Name" type="text"
                                                value="<?php echo e(old('last_name')); ?>" name="last_name">
                                        </label>
                                    </div>
                                    
                                    <div class="row">
                                        <label class="col-12 col-md-6">
                                            <input class="account__login--input" placeholder="Username" type="text"
                                            value="<?php echo e(old('name')); ?>" name="name">
                                        </label>

                                        <label class="col-12 col-md-6">
                                            <input class="account__login--input" placeholder="Phone" type="text"
                                                value="<?php echo e(old('phone')); ?>" name="phone">
                                        </label>
                                    </div>
                                    
                                    <label>
                                        
                                    </label>
                                    <label>
                                        <input class="account__login--input" placeholder="Email Address" type="email"
                                            value="<?php echo e(old('email')); ?>" name="email">
                                    </label>
                                    <label>
                                        <input class="account__login--input" placeholder="Password" type="password"
                                            name="password" id="password">
                                    </label>

                                    <label>
                                        <input class="account__login--input" placeholder="Confirm Password" type="password"
                                            name="password_confirmation" id="confirm_password">
                                    </label>

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" value="" id="show_pass"
                                            class="confirm_show_pass">
                                        <label class="form-check-label" for="show_pass">
                                            Show Password
                                        </label>
                                    </div>

                                    <input type="hidden" name="role" value="customer">
                                    
                                    <?php echo app('captcha')->display(); ?>

                                    <noscript>Please enable Javascript</noscript> 
                                    <button class="account__login--btn primary__btn mb-10" type="submit" id="register_btn">
                                        Register</button>
                                    <div class="account__login--remember position__relative">
                                        <input class="checkout__checkbox--input" id="terms_conditions" type="checkbox">
                                        <span class="checkout__checkbox--checkmark"></span>
                                        <label class="checkout__checkbox--label login__remember--label" for="terms_conditions">
                                            I have read and agree to the <a href="<?php echo e(route('termsConditions')); ?>">terms & conditions</a></label>
                                    </div>
                                    <div class="account__login--divide">
                                        <span class="account__login--divide__text">OR</span>
                                    </div>
                                    <p class="account__login--signup__text">Do you have already an Account? <a
                                            href="<?php echo e(route('login.form')); ?>">Login</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End registration section  -->

    <!-- Start shipping section -->
    <?php echo $__env->make('front.partials.shipping_sec', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <!-- End shipping section -->

    
    
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form[action="<?php echo e(route('register')); ?>"]');
    const termsCheckbox = document.getElementById('terms_conditions');
    const registerBtn = document.getElementById('register_btn');

    form.addEventListener('submit', function (e) {
        // Agar checkbox unchecked hai to form submit na ho
        if (!termsCheckbox.checked) {
            e.preventDefault(); // form submit hone se rok do
            alert('Please agree to the Terms & Conditions before registering.');
            termsCheckbox.focus();
        }
    });
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front.front-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u770170027/domains/carpartslb.com/public_html/resources/views/front/pages/register.blade.php ENDPATH**/ ?>