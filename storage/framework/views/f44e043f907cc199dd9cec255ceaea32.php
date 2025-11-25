<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin Login Page</title>
    <meta name="description" content="Morden Bootstrap HTML5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="public/assets/img/favicon.ico">

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500&display=swap"
        rel="stylesheet">

    <!-- Plugin css -->
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/front/css/vendor/bootstrap.min.css')); ?>">

    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/front/css/style.css')); ?>">
    <!-- My custom Style CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/front/css/custom.css')); ?>">

</head>

<body>
    <main class="main__content_wrapper">
        <!-- Start login section  -->
        <div class="login__section section--padding">
            <div class="container">
                <form action="<?php echo e(route('adminLogin')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="login__section--inner">
                        <div class="row row-cols-md-2 row-cols-1 d-flex justify-content-center align-items-center">
                            <div class="col">
                                <div class="account__login">
                                    <div class="account__login--header mb-25 d-flex flex-column justify-content-center align-items-center">
                                        <h2 class="account__login--header__title mb-10">
                                            <a class="main__logo--link" href="<?php echo e(route('home')); ?>"><img
                                                class="main__logo--img" src="<?php echo e(asset('public/assets/front/img/logo/car-part-lb.jpg')); ?>"
                                                alt="logo-img" width="199px"></a>
                                        </h2>
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
                                        <p class="account__login--header__desc">Admin Login</p>
                                    </div>
                                    <div class="account__login--inner">
                                        <label>
                                            <input class="account__login--input" placeholder="Email Address"
                                                type="email" name="email" value="<?php echo e(old('email')); ?>">
                                        </label>

                                        <label>
                                            <input class="account__login--input user_password" placeholder="Password" type="password"
                                                name="password">
                                        </label>

                                        <div class="form-check form-switch mb-4">
                                        <input class="form-check-input show_password" type="checkbox" role="switch"
                                            id="show_pass">
                                        <label class="form-check-label" for="show_pass">Show Password</label>
                                    </div>

                                        <div
                                            class="account__login--remember__forgot mb-15 d-flex justify-content-between align-items-center">
                                            <div class="account__login--remember position__relative">
                                                <input class="checkout__checkbox--input" id="check1" type="checkbox"
                                                    name="remember">
                                                <span class="checkout__checkbox--checkmark"></span>
                                                <label class="checkout__checkbox--label login__remember--label"
                                                    for="check1">
                                                    Remember me</label>
                                            </div>
                                            <a href="<?php echo e(route('password.request')); ?>" class="account__login--forgot"
                                                type="submit">Forgot Your
                                                Password?</a>
                                        </div>
                                        
                                        
                                        <input type="hidden" name="role" value="admin">
                                        <button class="account__login--btn primary__btn" type="submit">Admin Login</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End login section  -->
    </main>
    <!-- All Script JS Plugins here  -->
    <script src="<?php echo e(asset('public/assets/front/js/vendor/popper.js')); ?>" defer="defer"></script>
    <script src="<?php echo e(asset('public/assets/front/js/vendor/bootstrap.min.js')); ?>" defer="defer"></script>

    <!-- Custom my js -->
    <script src="<?php echo e(asset('public/assets/front/js/custom.js')); ?>"></script>

    <!-- Customscript js -->
    <script src="<?php echo e(asset('public/assets/front/js/script.js')); ?>"></script>

</body>

</html>
<?php /**PATH E:\sajjel\laragon\www\carpartslb.com\resources\views/front/pages/adminLogin.blade.php ENDPATH**/ ?>