<!DOCTYPE html>
<html lang="en">

<head>
    <?php if (isset($component)) { $__componentOriginal5b6bb7aaed4500e2d17932cc0cd89221 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5b6bb7aaed4500e2d17932cc0cd89221 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.Admin.head','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('Admin.head'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5b6bb7aaed4500e2d17932cc0cd89221)): ?>
<?php $attributes = $__attributesOriginal5b6bb7aaed4500e2d17932cc0cd89221; ?>
<?php unset($__attributesOriginal5b6bb7aaed4500e2d17932cc0cd89221); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5b6bb7aaed4500e2d17932cc0cd89221)): ?>
<?php $component = $__componentOriginal5b6bb7aaed4500e2d17932cc0cd89221; ?>
<?php unset($__componentOriginal5b6bb7aaed4500e2d17932cc0cd89221); ?>
<?php endif; ?>
</head>

<body class="skin-blue">
    <!-- Start Main Page Wrapper -->
    <div class="wrapper">
        <?php if (isset($component)) { $__componentOriginal007b8d29705766616fe70997670f24d2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal007b8d29705766616fe70997670f24d2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.Admin.header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('Admin.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal007b8d29705766616fe70997670f24d2)): ?>
<?php $attributes = $__attributesOriginal007b8d29705766616fe70997670f24d2; ?>
<?php unset($__attributesOriginal007b8d29705766616fe70997670f24d2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal007b8d29705766616fe70997670f24d2)): ?>
<?php $component = $__componentOriginal007b8d29705766616fe70997670f24d2; ?>
<?php unset($__componentOriginal007b8d29705766616fe70997670f24d2); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal685c30f0c32358f59b7a537e2056a8b1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal685c30f0c32358f59b7a537e2056a8b1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.Admin.sidebar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('Admin.sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal685c30f0c32358f59b7a537e2056a8b1)): ?>
<?php $attributes = $__attributesOriginal685c30f0c32358f59b7a537e2056a8b1; ?>
<?php unset($__attributesOriginal685c30f0c32358f59b7a537e2056a8b1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal685c30f0c32358f59b7a537e2056a8b1)): ?>
<?php $component = $__componentOriginal685c30f0c32358f59b7a537e2056a8b1; ?>
<?php unset($__componentOriginal685c30f0c32358f59b7a537e2056a8b1); ?>
<?php endif; ?>

        <!-- Right side column. Start Content Wrapper -->
        <div class="content-wrapper">
            <?php if (isset($component)) { $__componentOriginal231851546ae4979816f24ff1faa58d6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal231851546ae4979816f24ff1faa58d6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.Admin.content-header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('Admin.content-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal231851546ae4979816f24ff1faa58d6a)): ?>
<?php $attributes = $__attributesOriginal231851546ae4979816f24ff1faa58d6a; ?>
<?php unset($__attributesOriginal231851546ae4979816f24ff1faa58d6a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal231851546ae4979816f24ff1faa58d6a)): ?>
<?php $component = $__componentOriginal231851546ae4979816f24ff1faa58d6a; ?>
<?php unset($__componentOriginal231851546ae4979816f24ff1faa58d6a); ?>
<?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>

        </div>
        <!-- End Content Wrapper -->


        <?php if (isset($component)) { $__componentOriginala249bf44273798790a73e97d49be3aef = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala249bf44273798790a73e97d49be3aef = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.Admin.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('Admin.footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala249bf44273798790a73e97d49be3aef)): ?>
<?php $attributes = $__attributesOriginala249bf44273798790a73e97d49be3aef; ?>
<?php unset($__attributesOriginala249bf44273798790a73e97d49be3aef); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala249bf44273798790a73e97d49be3aef)): ?>
<?php $component = $__componentOriginala249bf44273798790a73e97d49be3aef; ?>
<?php unset($__componentOriginala249bf44273798790a73e97d49be3aef); ?>
<?php endif; ?>
    </div>
    <!-- End Main Page Wrapper -->
<?php if (isset($component)) { $__componentOriginal1ad6802ad0276afeb667f7c0615f7796 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1ad6802ad0276afeb667f7c0615f7796 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.Admin.script','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('Admin.script'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1ad6802ad0276afeb667f7c0615f7796)): ?>
<?php $attributes = $__attributesOriginal1ad6802ad0276afeb667f7c0615f7796; ?>
<?php unset($__attributesOriginal1ad6802ad0276afeb667f7c0615f7796); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1ad6802ad0276afeb667f7c0615f7796)): ?>
<?php $component = $__componentOriginal1ad6802ad0276afeb667f7c0615f7796; ?>
<?php unset($__componentOriginal1ad6802ad0276afeb667f7c0615f7796); ?>
<?php endif; ?>
</body>

</html><?php /**PATH /home/u770170027/domains/carpartslb.com/public_html/resources/views/layouts/admin/admin-layout.blade.php ENDPATH**/ ?>