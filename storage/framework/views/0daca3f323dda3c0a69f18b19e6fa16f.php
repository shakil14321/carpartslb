

<?php $__env->startSection('content'); ?>
<!-- Start breadcrumb section -->
<section class="breadcrumb__section breadcrumb__bg">
    <div class="container">
        <div class="row row-cols-1">
            <div class="col">
                <div class="breadcrumb__content text-center">
                    <ul class="breadcrumb__content--menu d-flex justify-content-center">
                        <li class="breadcrumb__content--menu__items"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                        <li class="breadcrumb__content--menu__items"><span>About Us</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End breadcrumb section -->

<!-- Start about section -->
<section class="about__section section--padding mb-95">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-12">
                <div class="about__content">
                    <span class="about__content--subtitle text__secondary mb-20"> Why Choose us</span>
                    <h2 class="about__content--maintitle mb-25" style="text-align: justify">We do not buy from the open market or random traders — every part we sell is 100% genuine and verified.</h2>
                    <p class="about__content--desc mb-20" style="text-align: justify">At <strong>CarPartsLB</strong>, we take pride in being Lebanon’s trusted source for genuine BMW, MINI, and BMW Motorrad spare parts. All our products come directly from authorized distributors and certified suppliers, ensuring you get original, factory-grade parts designed for perfect fit and performance.</p>
                    <p class="about__content--desc mb-25" style="text-align: justify">We understand how important quality and reliability are for your vehicle. That’s why we only offer authentic BMW parts, original MINI spare parts, and BMW Motorrad components — all inspected for quality, durability, and precision engineering.</p>
                    <p class="about__content--desc mb-25" style="text-align: justify">Whether you’re a car owner, garage, or dealer, you can rely on <strong>CarPartsLB</strong> for fast delivery, secure service, and expert support 24/7 via WhatsApp. We make it easy to buy genuine BMW, MINI, and Motorrad parts in Lebanon online, with confidence and peace of mind.</p>
                    <p class="about__content--desc mb-25" style="text-align: justify">Choose <strong>CarPartsLB</strong> — where quality, trust, and originality drive everything.we do.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End about section -->

<!-- Start counterup banner section -->
<div class="counterup__banner--section counterup__banner__bg2" id="funfactId">
    <div class="container">
        <div class="row py-5">
            <div class="counterup__items text-center col-12 col-sm-6 col-md-3 py-5">
                        <h2 class="counterup__title">YEARS OF <br>
                            FOUNDATION</h2>
                        <span class="counterup__number js-counter" data-count="50">0</span>
                    </div>
            <div class="counterup__items text-center col-12 col-sm-6 col-md-3 py-5">
                        <h2 class="counterup__title">SKILLED TEAM <br>
                            MEMBERS </h2>
                        <span class="counterup__number js-counter" data-count="100">0</span>
                    </div>
            <div class="counterup__items text-center col-12 col-sm-6 col-md-3 py-5">
                        <h2 class="counterup__title">HAPPY <br>
                            CUSTOMERS</h2>
                        <span class="counterup__number js-counter" data-count="80">0</span>
                    </div>
            <div class="counterup__items text-center col-12 col-sm-6 col-md-3 py-5">
                        <h2 class="counterup__title">MONTHLY <br>
                            ORDERS</h2>
                        <span class="counterup__number js-counter" data-count="70">0</span>
                    </div>
        </div>
    </div>
</div>
<!-- End counterup banner section -->

<!-- Start shipping section -->
<?php echo $__env->make('front.partials.shipping_sec', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<!-- End shipping section -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.front-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u770170027/domains/carpartslb.com/public_html/resources/views/front/pages/about.blade.php ENDPATH**/ ?>