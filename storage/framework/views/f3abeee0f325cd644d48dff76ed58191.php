<!DOCTYPE html>
<html lang="en">

<head>
    <?php if (isset($component)) { $__componentOriginal38bfd94ad3013240b0ff201e32dc0f40 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal38bfd94ad3013240b0ff201e32dc0f40 = $attributes; } ?>
<?php $component = App\View\Components\Admin\Head::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('Admin.head'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Admin\Head::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal38bfd94ad3013240b0ff201e32dc0f40)): ?>
<?php $attributes = $__attributesOriginal38bfd94ad3013240b0ff201e32dc0f40; ?>
<?php unset($__attributesOriginal38bfd94ad3013240b0ff201e32dc0f40); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal38bfd94ad3013240b0ff201e32dc0f40)): ?>
<?php $component = $__componentOriginal38bfd94ad3013240b0ff201e32dc0f40; ?>
<?php unset($__componentOriginal38bfd94ad3013240b0ff201e32dc0f40); ?>
<?php endif; ?>
</head>

<body class="skin-blue">
    <!-- Start Main Page Wrapper -->
    <div class="wrapper">
        <?php if (isset($component)) { $__componentOriginal45d9cbba1e84739af2366cafaf311004 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal45d9cbba1e84739af2366cafaf311004 = $attributes; } ?>
<?php $component = App\View\Components\Admin\Header::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('Admin.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Admin\Header::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal45d9cbba1e84739af2366cafaf311004)): ?>
<?php $attributes = $__attributesOriginal45d9cbba1e84739af2366cafaf311004; ?>
<?php unset($__attributesOriginal45d9cbba1e84739af2366cafaf311004); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal45d9cbba1e84739af2366cafaf311004)): ?>
<?php $component = $__componentOriginal45d9cbba1e84739af2366cafaf311004; ?>
<?php unset($__componentOriginal45d9cbba1e84739af2366cafaf311004); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginale842643f388f3f2a729c3cad188d3504 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale842643f388f3f2a729c3cad188d3504 = $attributes; } ?>
<?php $component = App\View\Components\Admin\Sidebar::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('Admin.sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Admin\Sidebar::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale842643f388f3f2a729c3cad188d3504)): ?>
<?php $attributes = $__attributesOriginale842643f388f3f2a729c3cad188d3504; ?>
<?php unset($__attributesOriginale842643f388f3f2a729c3cad188d3504); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale842643f388f3f2a729c3cad188d3504)): ?>
<?php $component = $__componentOriginale842643f388f3f2a729c3cad188d3504; ?>
<?php unset($__componentOriginale842643f388f3f2a729c3cad188d3504); ?>
<?php endif; ?>

        <!-- Right side column. Start Content Wrapper -->
        <div class="content-wrapper">
            <?php if (isset($component)) { $__componentOriginalbbd5cce371bfa5e66bba956468901412 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbbd5cce371bfa5e66bba956468901412 = $attributes; } ?>
<?php $component = App\View\Components\Admin\ContentHeader::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('Admin.content-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Admin\ContentHeader::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbbd5cce371bfa5e66bba956468901412)): ?>
<?php $attributes = $__attributesOriginalbbd5cce371bfa5e66bba956468901412; ?>
<?php unset($__attributesOriginalbbd5cce371bfa5e66bba956468901412); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbbd5cce371bfa5e66bba956468901412)): ?>
<?php $component = $__componentOriginalbbd5cce371bfa5e66bba956468901412; ?>
<?php unset($__componentOriginalbbd5cce371bfa5e66bba956468901412); ?>
<?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>

        </div>
        <!-- End Content Wrapper -->


        <?php if (isset($component)) { $__componentOriginalb8e9be121ac5809d76d4768b3abc0902 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb8e9be121ac5809d76d4768b3abc0902 = $attributes; } ?>
<?php $component = App\View\Components\Admin\Footer::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('Admin.footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Admin\Footer::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb8e9be121ac5809d76d4768b3abc0902)): ?>
<?php $attributes = $__attributesOriginalb8e9be121ac5809d76d4768b3abc0902; ?>
<?php unset($__attributesOriginalb8e9be121ac5809d76d4768b3abc0902); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb8e9be121ac5809d76d4768b3abc0902)): ?>
<?php $component = $__componentOriginalb8e9be121ac5809d76d4768b3abc0902; ?>
<?php unset($__componentOriginalb8e9be121ac5809d76d4768b3abc0902); ?>
<?php endif; ?>
    </div>
    <!-- End Main Page Wrapper -->
<?php if (isset($component)) { $__componentOriginalc7f78f671dd79525485767957a56d3bf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc7f78f671dd79525485767957a56d3bf = $attributes; } ?>
<?php $component = App\View\Components\Admin\Script::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('Admin.script'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Admin\Script::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc7f78f671dd79525485767957a56d3bf)): ?>
<?php $attributes = $__attributesOriginalc7f78f671dd79525485767957a56d3bf; ?>
<?php unset($__attributesOriginalc7f78f671dd79525485767957a56d3bf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc7f78f671dd79525485767957a56d3bf)): ?>
<?php $component = $__componentOriginalc7f78f671dd79525485767957a56d3bf; ?>
<?php unset($__componentOriginalc7f78f671dd79525485767957a56d3bf); ?>
<?php endif; ?>
</body>

</html><?php /**PATH E:\sajjel\laragon\www\carpartslb.com\resources\views/layouts/admin/admin-layout.blade.php ENDPATH**/ ?>