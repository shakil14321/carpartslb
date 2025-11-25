<?php $__env->startSection('content'); ?>
<!-- Start breadcrumb section -->
<section class="breadcrumb__section breadcrumb__bg">
    <div class="container">
        <div class="row row-cols-1">
            <div class="col">
                <div class="breadcrumb__content text-center">
                    <h1 class="breadcrumb__content--title">Search Results For: <?php echo e(request()->query('query')); ?></h1>
                    <ul class="breadcrumb__content--menu d-flex justify-content-center">
                        <li class="breadcrumb__content--menu__items"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                        <li class="breadcrumb__content--menu__items"><span>Search</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End breadcrumb section -->

<!-- Start shop section -->
<div class="shop__section section--padding">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 shop-col-width-lg-4">
                <div class="shop__sidebar--widget widget__area d-none d-lg-block">

                    
                    <div class="single__widget price__filter widget__bg">
                        <h2 class="widget__title h3">Filter By Price</h2>
                        <form id="price-filter-form">
                            <div class="price__filter--form__inner mb-15 d-flex align-items-center">
                                <div class="price__filter--group">
                                    <label class="price__filter--label" for="Filter-Price-GTE">From</label>
                                    <div class="price__filter--input d-flex align-items-center">
                                        <span class="price__filter--currency">$</span>
                                        <input class="price__filter--input__field border-0 custom_price_field" name="min_price"
                                               id="Filter-Price-GTE" type="number" placeholder="0"
                                               value="<?php echo e(request('min_price')); ?>">
                                    </div>
                                </div>
                                <div class="price__divider"><span>-</span></div>
                                <div class="price__filter--group">
                                    <label class="price__filter--label" for="Filter-Price-LTE">To</label>
                                    <div class="price__filter--input d-flex align-items-center">
                                        <span class="price__filter--currency">$</span>
                                        <input class="price__filter--input__field border-0 custom_price_field" name="max_price"
                                               id="Filter-Price-LTE" type="number" placeholder="250"
                                               value="<?php echo e(request('max_price')); ?>">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="primary__btn price__filter--btn">Filter</button>
                        </form>
                    </div>
                    

                    <div class="single__widget widget__bg">
                        <h2 class="widget__title h3">Categories</h2>
                        <ul class="widget__categories--menu">
                            <?php if($carPartTypes): ?>
                            <?php $__currentLoopData = $carPartTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $carPartType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="widget__categories--menu__list">
                                <a href="<?php echo e(route('type.view', $carPartType->slug)); ?>">
                                    <label class="widget__categories--menu__label d-flex align-items-center">
                                        <img class="widget__categories--menu__img" src="<?php echo e($carPartType->part_type_image 
                                            ? asset('public/assets/front/img/product/small-product/' . $carPartType->part_type_image) 
                                            : asset('public/assets/front/img/product/small-product/product1.webp')); ?>"
                                            alt="categories-img">

                                        <span class="widget__categories--menu__text"><?php echo e($carPartType->title); ?></span>
                                    </label>
                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <h5>Categories not found.</h5>
                            <?php endif; ?>
                        </ul>
                    </div>

                    
                    <div class="single__widget widget__bg">
                        <h2 class="widget__title h3">Top Featured Products</h2>
                        <div class="shop__sidebar--product">
                            <?php if($carPartsFav->count() > 0): ?>
                            <?php $__currentLoopData = $carPartsFav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $carPartFav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="small__product--card d-flex">
                                <div class="small__product--thumbnail">
                                    <?php if($carPartFav->feature_image): ?>
                                    <img class="product__card--thumbnail__img product__primary--img"
                                        src="<?php echo e(asset('public/images/parts/feature/' . $carPartFav->feature_image)); ?>"
                                        alt="feature_img">
                                    <?php else: ?>
                                    <img class="product__card--thumbnail__img product__primary--img"
                                        src="<?php echo e(asset('public/images/brands/demo.png')); ?>" alt="no-image">
                                    <?php endif; ?>

                                    <a class="display-block" href="<?php echo e(route('product.details', $carPartFav->slug)); ?>">
                                        <img src="" alt="product-img">
                                    </a>
                                </div>
                                <div class="small__product--content">
                                    <h3 class="small__product--card__title">
                                        <a href="<?php echo e(route('product.details', $carPartFav->slug)); ?>">
                                            <?php echo e($carPartFav->title ?? ''); ?>

                                        </a>
                                    </h3>
                                    <div class="small__product--card__price">
                                        <span class="current__price">
                                            <?php echo e('$' . ($carPartFav->sale_price ?? $carPartFav->original_price)); ?>

                                        </span>
                                    </div>
                                    
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <h5>Products not found</h5>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 shop-col-width-lg-8">
                <?php if(session('success')): ?>
                    <div  class="alert alert-success message_section"><?php echo e(session('success')); ?></div>                    
                <?php endif; ?>
                <div class="shop__right--sidebar">
                    <div class="shop__product--wrapper">
                        <div class="shop__header d-flex align-items-center justify-content-between mb-30">
                            <div class="product__view--mode d-flex align-items-center">
                                <button class="widget__filter--btn d-flex d-lg-none align-items-center" data-offcanvas>
                                    <svg class="widget__filter--btn__icon" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="28"
                                            d="M368 128h80M64 128h240M368 384h80M64 384h240M208 256h240M64 256h80" />
                                        <circle cx="336" cy="128" r="28" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="28" />
                                        <circle cx="176" cy="256" r="28" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="28" />
                                        <circle cx="336" cy="384" r="28" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="28" />
                                    </svg>
                                    <span class="widget__filter--btn__text">Filter</span>
                                </button>

                                <div class="product__view--mode__list product__short--by align-items-center d-flex">
                                    <label class="product__view--label">Sort By :</label>
                                    <div class="select shop__header--select">
                                        <select id="sort_by" class="product__view--select">
                                            <option value="1" selected>Sort by latest</option>
                                            <option value="2">Sort by low to high price</option>
                                            <option value="3">Sort by high to low price</option>
                                            
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <p class="product__showing--count">
                                Showing <?php echo e($carParts->firstItem()); ?>–<?php echo e($carParts->lastItem()); ?> of <?php echo e($carParts->total()); ?> results
                            </p>

                        </div>
                        <div class="tab_content">
                            
                            <div id="product_grid" class="tab_pane active show">
                                <div class="product__section--inner">
                                    <div class="row mb--n30" id="car-parts-container">
                                        <?php echo $__env->make('front.partials.car_parts_list', ['carParts' => $carParts], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End shop section -->

<!-- Start shipping section -->
<?php echo $__env->make('front.partials.shipping_sec', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<!-- End shipping section -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.front-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\sajjel\laragon\www\carpartslb.com\resources\views/front/pages/search.blade.php ENDPATH**/ ?>