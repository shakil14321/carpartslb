<div class="header__bottom bg__primary py-3">
    <div class="container">
        <div class="header__bottom--inner position__relative d-flex align-items-center">
            <div class="header__right--area d-flex justify-content-between align-items-center">
                <div class="header__menu">
                    <nav class="header__menu--navigation">
                        <ul class="header__menu--wrapper d-flex">
                             <?php
                                $setting = \App\Models\SiteSetting::first();
                            ?>
                            <?php if($setting && !empty($setting->menu_items)): ?>
                                <?php $__currentLoopData = $setting->menu_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="header__menu--items">
                                        <?php
                                            $routeName = $menu['name'];
                                        ?>
                                        <a href="<?php echo e($menu['link']); ?>" class="header__menu--link text-white <?php echo e(request()->routeIs(strtolower($routeName)) ? 'active' : ''); ?>"><?php echo e($menu['name']); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            <?php else: ?>
                            <p class="text-white">Menu items not found.</p>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
<<<<<<<< HEAD:storage/framework/views/eb4fd708a3465d55e0d240f90cd9bd1c.php
</div><?php /**PATH F:\laragon\www\carpartslb.com\resources\views/components/Front/header_menu.blade.php ENDPATH**/ ?>
========
</div><?php /**PATH E:\sajjel\laragon\www\carpartslb.com\resources\views/components/Front/header_menu.blade.php ENDPATH**/ ?>
>>>>>>>> 111d9aad5c681fcad64fc7e1745777f4ca95bd73:storage/framework/views/c548f9b124f9f48cbff953a0dee09aaf.php
