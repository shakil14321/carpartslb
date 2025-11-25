<?php $__env->startSection('content'); ?>
<!-- Start slider section -->
<section class="hero__slider--section slider__section--bg2 section--padding">
    <div class="container">
        <div class="row row-md-reverse">
            <div class="col-lg-12">
                <div class="hero__slider--inner hero__slider--activation swiper">
                    <div class="hero__slider--wrapper swiper-wrapper">
                        <div class="swiper-slide ">
                            <div class="hero__slider--items__style2 home2-slider1-bg">
                                <div class="slider__content style2">
                                    <span class="slider__subtitle text__secondary">SHOP THE VERY BEST</span>
                                    <h2 class="slider__maintitle--style2 h1">AUTO PARTS <br> & ACCESSORIES</h2>
                                    <p class="slider__desc text__secondary">High Quality - Extreme Performance</p>
                                    <a class="primary__btn slider__btn" href="<?php echo e(route('shop')); ?>">
                                        Shop now
                                        <svg width="12" height="8" viewBox="0 0 12 8" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.8335 3.6178L8.26381 0.157332C8.21395 0.107774 8.1532 0.0681771 8.08544 0.0410843C8.01768 0.0139915 7.94441 0 7.87032 0C7.79624 0 7.72297 0.0139915 7.65521 0.0410843C7.58745 0.0681771 7.5267 0.107774 7.47684 0.157332C7.37199 0.262044 7.31393 0.39827 7.31393 0.539537C7.31393 0.680805 7.37199 0.817024 7.47684 0.921736L10.0943 3.45837H0.55625C0.405122 3.46829 0.26375 3.52959 0.160556 3.62994C0.057363 3.73029 0 3.86225 0 3.99929C0 4.13633 0.057363 4.26829 0.160556 4.36864C0.26375 4.46899 0.405122 4.53029 0.55625 4.54021H10.0927L7.47527 7.07826C7.37042 7.18298 7.31235 7.3192 7.31235 7.46047C7.31235 7.60174 7.37042 7.73796 7.47527 7.84267C7.52513 7.89223 7.58588 7.93182 7.65364 7.95892C7.7214 7.98601 7.79467 8 7.86875 8C7.94284 8 8.0161 7.98601 8.08386 7.95892C8.15162 7.93182 8.21238 7.89223 8.26223 7.84267L11.8335 4.38932C11.9406 4.28419 12 4.14649 12 4.00356C12 3.86063 11.9406 3.72293 11.8335 3.6178V3.6178Z"
                                                fill="currentColor" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="hero__slider--layer__style2">
                                    <?php
                                        $setting = \App\Models\SiteSetting::first();
                                    ?>
                                        <img class="slider__layer--img "
                                            src="<?php echo e($setting && $setting->carousel_image_one ? asset('public/images/banners/' . $setting->carousel_image_one) : asset('public/assets/front/img/slider/home-slider1-layer.png')); ?>"
                                            alt="slider-img">
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide ">
                            <div class="hero__slider--items__style2 home2-slider1-bg">
                                <div class="slider__content style2">
                                    <span class="slider__subtitle text__secondary">SHOP THE VERY BEST</span>
                                    <h2 class="slider__maintitle--style2 h1">AUTO PARTS <br> & ACCESSORIES</h2>
                                    <p class="slider__desc text__secondary">High Quality - Extreme Performance</p>
                                    <a class="primary__btn slider__btn" href="<?php echo e(route('shop')); ?>">
                                        Shop now
                                        <svg width="12" height="8" viewBox="0 0 12 8" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.8335 3.6178L8.26381 0.157332C8.21395 0.107774 8.1532 0.0681771 8.08544 0.0410843C8.01768 0.0139915 7.94441 0 7.87032 0C7.79624 0 7.72297 0.0139915 7.65521 0.0410843C7.58745 0.0681771 7.5267 0.107774 7.47684 0.157332C7.37199 0.262044 7.31393 0.39827 7.31393 0.539537C7.31393 0.680805 7.37199 0.817024 7.47684 0.921736L10.0943 3.45837H0.55625C0.405122 3.46829 0.26375 3.52959 0.160556 3.62994C0.057363 3.73029 0 3.86225 0 3.99929C0 4.13633 0.057363 4.26829 0.160556 4.36864C0.26375 4.46899 0.405122 4.53029 0.55625 4.54021H10.0927L7.47527 7.07826C7.37042 7.18298 7.31235 7.3192 7.31235 7.46047C7.31235 7.60174 7.37042 7.73796 7.47527 7.84267C7.52513 7.89223 7.58588 7.93182 7.65364 7.95892C7.7214 7.98601 7.79467 8 7.86875 8C7.94284 8 8.0161 7.98601 8.08386 7.95892C8.15162 7.93182 8.21238 7.89223 8.26223 7.84267L11.8335 4.38932C11.9406 4.28419 12 4.14649 12 4.00356C12 3.86063 11.9406 3.72293 11.8335 3.6178V3.6178Z"
                                                fill="currentColor" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="hero__slider--layer__style2">
                                    <img class="slider__layer--img "
                                            src="<?php echo e($setting && $setting->carousel_image_two ? asset('public/images/banners/' . $setting->carousel_image_two) : asset('public/assets/front/img/slider/home-slider2-layer.png')); ?>"
                                            alt="slider-img">
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide ">
                            <div class="hero__slider--items__style2 home2-slider1-bg">
                                <div class="slider__content style2">
                                    <span class="slider__subtitle text__secondary">SHOP THE VERY BEST</span>
                                    <h2 class="slider__maintitle--style2 h1">AUTO PARTS <br> & ACCESSORIES</h2>
                                    <p class="slider__desc text__secondary">High Quality - Extreme Performance</p>
                                    <a class="primary__btn slider__btn" href="<?php echo e(route('shop')); ?>">
                                        Shop now
                                        <svg width="12" height="8" viewBox="0 0 12 8" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.8335 3.6178L8.26381 0.157332C8.21395 0.107774 8.1532 0.0681771 8.08544 0.0410843C8.01768 0.0139915 7.94441 0 7.87032 0C7.79624 0 7.72297 0.0139915 7.65521 0.0410843C7.58745 0.0681771 7.5267 0.107774 7.47684 0.157332C7.37199 0.262044 7.31393 0.39827 7.31393 0.539537C7.31393 0.680805 7.37199 0.817024 7.47684 0.921736L10.0943 3.45837H0.55625C0.405122 3.46829 0.26375 3.52959 0.160556 3.62994C0.057363 3.73029 0 3.86225 0 3.99929C0 4.13633 0.057363 4.26829 0.160556 4.36864C0.26375 4.46899 0.405122 4.53029 0.55625 4.54021H10.0927L7.47527 7.07826C7.37042 7.18298 7.31235 7.3192 7.31235 7.46047C7.31235 7.60174 7.37042 7.73796 7.47527 7.84267C7.52513 7.89223 7.58588 7.93182 7.65364 7.95892C7.7214 7.98601 7.79467 8 7.86875 8C7.94284 8 8.0161 7.98601 8.08386 7.95892C8.15162 7.93182 8.21238 7.89223 8.26223 7.84267L11.8335 4.38932C11.9406 4.28419 12 4.14649 12 4.00356C12 3.86063 11.9406 3.72293 11.8335 3.6178V3.6178Z"
                                                fill="currentColor" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="hero__slider--layer__style2">
                                    <img class="slider__layer--img "
                                            src="<?php echo e($setting && $setting->carousel_image_three ? asset('public/images/banners/' . $setting->carousel_image_three) : asset('public/assets/front/img/slider/home-slider4-layer.png')); ?>"
                                            alt="slider-img">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper__nav--btn swiper-button-next">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class=" -chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                    <div class="swiper__nav--btn swiper-button-prev">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class=" -chevron-left">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- End slider section -->


<section class="brands_section">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-10 col-md-4 text-center">
                <div class="brand_heading text-center section__heading--maintitle"><h2>Select By Brand</h2></div>
            </div>
        </div>
        <div class="row">
            <?php if($carBrands->count() > 0): ?>
                <?php $__currentLoopData = $carBrands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $carBrand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 col-sm-6 col-md-4 justify-content-center align-items-center">
                    <div class="brand_img_wrap card mb-4">
                        <a href="<?php echo e(route('brand.view', $carBrand->slug)); ?>"><img src="<?php echo e($carBrand->brand_image ? asset('public/images/brands/' . $carBrand->brand_image) : asset('public/images/brands/demo.png')); ?>" alt="<?php echo e($carBrand->title); ?>"></a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
            <?php else: ?>
            <h3 class="product__card--title">Brands not found.</h3>
            <?php endif; ?>
            
        </div>
    </div>
</section>


<!-- Start product section -->
<section class="product__section section--padding  pt-0">
    <div class="container">
        <div class="section__heading border-bottom mb-30">
            <h2 class="section__heading--maintitle">Featured <span>Products</span></h2>
        </div>
        <div class="product__section--inner pb-15 product__swiper--activation swiper">
            <div class="swiper-wrapper">
                <?php echo $__env->make('front.partials.car_part_list_slide', ['carParts' => $carParts], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
            <div class="swiper__nav--btn swiper-button-next">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class=" -chevron-right">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </div>
            <div class="swiper__nav--btn swiper-button-prev">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class=" -chevron-left">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </div>

        </div>
    </div>
</section>
<!-- End product section -->





<div class="confirmatio_part_sec">
    <div class="container">
        
        <div class="row mb-4">
            <div class="col-12">
                <div class="section__heading border-bottom mb-30">
                    <h2 class="mb-2 section__heading--maintitle">Need Help <span>with Your Order?</span></h2>
                    <p>We’re available on <a href="http://wa.me/+96176380584"><strong>WhatsApp</strong></a> to assist you with. Click here to direct to <a
                            href="http://wa.me/+96176380584"><strong>WhatsApp</strong></a> button anytime to chat
                        directly with our support team</p>
                </div>
            </div>
        </div>

        
        <div class="row g-4">
            <div class="col-12 col-md-6 col-xl-4">
                <div class="card h-100 text-center custom-card">
                    <div class="mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-calendar-check-icon lucide-calendar-check">
                            <path d="M8 2v4" />
                            <path d="M16 2v4" />
                            <rect width="18" height="18" x="3" y="4" rx="2" />
                            <path d="M3 10h18" />
                            <path d="m9 16 2 2 4-4" />
                        </svg>
                        </svg>
                    </div>
                    <h3 class="mb-2">Confirm Parts</h3>
                    <p class="mb-0">Reach us through <a href="http://wa.me/+96176380584"><strong>WhatsApp</strong></a> to confirm if a specific
                        part will properly fit your car model before making
                        your purchase.</p>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <div class="card h-100 text-center custom-card">
                    <div class="mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-messages-square-icon lucide-messages-square">
                            <path
                                d="M16 10a2 2 0 0 1-2 2H6.828a2 2 0 0 0-1.414.586l-2.202 2.202A.71.71 0 0 1 2 14.286V4a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z" />
                            <path
                                d="M20 9a2 2 0 0 1 2 2v10.286a.71.71 0 0 1-1.212.502l-2.202-2.202A2 2 0 0 0 17.172 19H10a2 2 0 0 1-2-2v-1" />
                        </svg>
                    </div>
                    <h4 class="mb-2">Discussion On Specificaton</h4>
                    <p class="mb-0">Contact us directly for a detailed discussion regarding any part’s specifications to
                        ensure accurate information before making your purchase decision.</p>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <div class="card h-100 text-center custom-card">
                    <div class="mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-package-search-icon lucide-package-search">
                            <path
                                d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14" />
                            <path d="m7.5 4.27 9 5.15" />
                            <polyline points="3.29 7 12 12 20.71 7" />
                            <line x1="12" x2="12" y1="22" y2="12" />
                            <circle cx="18.5" cy="15.5" r="2.5" />
                            <path d="M20.27 17.27 22 19" />
                        </svg>
                    </div>
                    <h4 class="mb-2">Help To Find Parts</h4>
                    <p class="mb-0">We assist in locating any required parts. Contact us for professional guidance and
                        support to help you find exactly what you need.</p>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Start shipping section -->
<?php echo $__env->make('front.partials.shipping_sec', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<!-- End shipping section -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front.front-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\sajjel\laragon\www\carpartslb.com\resources\views/front/pages/home.blade.php ENDPATH**/ ?>