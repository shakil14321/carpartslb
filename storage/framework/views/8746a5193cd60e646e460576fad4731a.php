<!-- Start product section -->
<section class="brand_bar_wrapper">
    <div class="container pt-3">
        <div class="product__section--inner pb-15">
            <div class="slide_wrapper">
                <?php
                    $setting = \App\Models\SiteSetting::first();
                    $carBrandQuantity = $setting ? $setting->brand_quantity : 0;
                    $carPartBrands = \App\Models\CarPartBrand::take($carBrandQuantity)->get();
                ?>
                
                <?php if($carPartBrands->count() > 0): ?>
                    <?php $__currentLoopData = $carPartBrands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $carPartBrand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="slide_item">
                            <p class="bar_brands_names">
                                <a href="<?php echo e(route('partBrand.view', $carPartBrand->slug)); ?>"><?php echo e($carPartBrand->title); ?></a>
                            </p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <p class="product__card--title text-white">Car brands not found.</p> 
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!-- End product section -->


<!-- JS -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const links = document.querySelectorAll(".bar_brands_names a");

    if (links.length > 0) {
        links.forEach(link => link.classList.remove("active"));

        const currentUrl = window.location.href;
        links.forEach(link => {
            if (link.href === currentUrl) {
                link.classList.add("active");
            }
        });

        links.forEach(link => {
            link.addEventListener("click", function (e) {
                links.forEach(l => l.classList.remove("active"));
                this.classList.add("active");
            });
        });
    }
});
</script>

<<<<<<<< HEAD:storage/framework/views/bedb64f658b88a34e50f56408b43d253.php
<?php /**PATH F:\laragon\www\carpartslb.com\resources\views/components/front/brands-bar.blade.php ENDPATH**/ ?>
========
<?php /**PATH E:\sajjel\laragon\www\carpartslb.com\resources\views/components/front/brands-bar.blade.php ENDPATH**/ ?>
>>>>>>>> 111d9aad5c681fcad64fc7e1745777f4ca95bd73:storage/framework/views/8746a5193cd60e646e460576fad4731a.php
