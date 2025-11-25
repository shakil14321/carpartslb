<?php $__env->startSection('content'); ?>
    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content text-center">
                        <ul class="breadcrumb__content--menu d-flex justify-content-center">
                            <li class="breadcrumb__content--menu__items"><a
                                    href="<?php echo e(route('customerDashboard')); ?>">Dashboard</a></li>
                            <li class="breadcrumb__content--menu__items"><span>My Account</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->

    <!-- my account section start -->
    <section class="my__account--section section--padding">
        <div class="container">
            <p class="account__welcome--text">Hello, <?php echo e(Auth::user()->name); ?> welcome to your dashboard!</p>
            <?php if(session('success')): ?>
                <div class="alert alert-success message_section" style="margin:20px;">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger main-danger message_section">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <div class="my__account--section__inner border-radius-10 d-flex">
                <div class="account__left--sidebar">
                    <h2 class="account__content--title mb-20">My Profile</h2>
                    <ul class="account__menu">
                        <li class="account__menu--list active account_link" data-target="order_history"><a
                                href="#">Dashboard</a></li>
                        <li class="account__menu--list account_link" data-target="address"><a href="#">Addresses</a>
                        </li>
                        <li class="account__menu--list account_link" data-target="user_setting"><a
                                href="#">Setting</a></li>
                        
                        <form action="<?php echo e(route('logout')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <li class="account__menu--list"><button type="submit" class="logout_btn">Log Out</button></li>
                        </form>
                    </ul>
                </div>
                
                <div class="account__wrapper account_section" id="order_history">
                    <div class="account__content">
                        <h2 class="account__content--title h3 mb-20">Orders History</h2>
                        <div class="account__table--area">
                            <table class="account__table">
                                <thead class="account__table--header">
                                    <tr class="account__table--header__child">
                                        <th class="account__table--header__child--items">Sr #</th>
                                        <th class="account__table--header__child--items">Order #</th>
                                        <th class="account__table--header__child--items">Customer Name</th>
                                        <th class="account__table--header__child--items">Date & Time</th>
                                        <th class="account__table--header__child--items">Payment</th>
                                        <th class="account__table--header__child--items">Status</th>
                                        <th class="account__table--header__child--items">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="account__table--body mobile__none">
                                    <?php if($orders->count() > 0): ?>
                                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="account__table--body__child">
                                                <td class="account__table--body__child--items"><?php echo e($loop->iteration); ?></td>
                                                <td class="account__table--body__child--items"><a href="<?php echo e(route('orderView.customer',  ['id' => $order->id])); ?>"><?php echo e($order->order_number ?? ''); ?></a></td>
                                                <td class="account__table--body__child--items">
                                                    <?php echo e(ucwords(trim(($order->first_name ?? '') . ' ' . ($order->last_name ?? '')))); ?>

                                                </td>
                                                <td class="account__table--body__child--items">
                                                    <?php echo e($order->updated_at ?? ''); ?></td>
                                                <td class="account__table--body__child--items"><?php echo e(strtoupper($order->payment_method) ?? ''); ?></td>
                                                <td class="account__table--body__child--items"><?php echo e(ucwords($order->status) ?? ''); ?>

                                                </td>
                                                <td class="account__table--body__child--items"><?php echo e($order->total ? $order->total : ''); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr class="account__table--body__child">
                                            <td colspan="7" class="account__table--body__child--items text-center">Orders not found.</td>
                                        </tr>
                                    <?php endif; ?>

                                </tbody>
                                <tbody class="account__table--body mobile__block">
                                    <?php if($orders->count() > 0): ?>
                                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="account__table--body__child">
                                                <td class="account__table--body__child--items">
                                                    <strong>Order #</strong>
                                                    <span><?php echo e($loop->iteration); ?></span>
                                                </td>
                                                <td class="account__table--body__child--items">
                                                    <strong>Customer Name</strong>
                                                    <span><?php echo e(trim(($order->first_name ?? '') . ' ' . ($order->last_name ?? ''))); ?></span>
                                                </td>
                                                <td class="account__table--body__child--items">
                                                    <strong>Date</strong>
                                                    <span><?php echo e($order->updated_at ?? ''); ?></span>
                                                </td>
                                                <td class="account__table--body__child--items">
                                                    <strong>Order Type</strong>
                                                    <span><?php echo e($order->type ?? ''); ?></span>
                                                </td>
                                                <td class="account__table--body__child--items">
                                                    <strong>Order Process</strong>
                                                    <span><?php echo e($order->status ?? ''); ?></span>
                                                </td>
                                                <td class="account__table--body__child--items">
                                                    <strong>Total</strong>
                                                    <span><?php echo e($order->total ? '$'.$order->total : ''); ?></span>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr class="account__table--body__child">
                                            <td colspan="6" class="account__table--body__child--items text-center">Orders not found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                

                
                <div class="account__wrapper account_section" id="address">
                    <h2 class="account__content--title h2 mb-20">Addresses</h2>
                    <a href="<?php echo e(route('address.create')); ?>" class="new__address--btn primary__btn mb-25">Add a new
                        address</a>
                    <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="account__content">
                            <div class="account__details two">
                                <div class="address_type d-flex justify-content-start align-items-center gap-2">
                                    <h4 class="account__details--title h4">Address Type: </h4>
                                    <p class="account__details--desc" style="margin:-7px 0 0 0 !important;">
                                        <?php echo e(ucwords($address->type)); ?>

                                        <?php echo e($address->is_default == 1 ? '(Default)' : ''); ?></p>
                                </div>
                                <div class="address_type d-flex justify-content-start align-items-center gap-2">
                                    <h4 class="account__details--title h4">Address : </h4>
                                    <?php
                                        $addressParts = array_filter([
                                            $address->address_line_1 ?? null,
                                            $address->address_line_2 ?? null,
                                            $address->city ?? null,
                                            $address->state ?? null,
                                            $address->country ?? null,
                                        ]);
                                    ?>
                                    <p class="account__details--desc" style="margin:-7px 0 0 0 !important;">
                                        <?php echo e(ucwords(implode(', ', $addressParts))); ?></p>
                                </div>
                                <div class="address_type d-flex justify-content-start align-items-center gap-2">
                                    <h4 class="account__details--title h4">Postal Code: </h4>
                                    <p class="account__details--desc" style="margin:-7px 0 0 0 !important;">
                                        <?php echo e(ucwords($address->postal_code)); ?></p>
                                </div>
                            </div>
                            <div class="d-flex gap-3 mb-5 mt-3">
                                <a href="<?php echo e(route('address.edit', $address->id)); ?>"
                                    class="btn py-2 px-5 fs-4 bg-none border-dark rounded-pill c_btn"
                                    type="button">Edit</a>
                                <form action="<?php echo e(route('address.destroy', $address->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn py-2 px-5 fs-4 bg-none border-dark rounded-pill c_btn"
                                        type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                

                
                <div class="account__wrapper account_section" id="user_setting">
                    <div class="account__content">
                        <form action="<?php echo e(route('customer.update')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="login__section--inner">
                                <div class="row row-cols-md-2 row-cols-1">
                                    <div class="col">
                                        <div class="">
                                            <div class="account__login--header mb-25">
                                            </div>
                                            <div class="account__login--inner">
                                                <label>
                                                    <input class="account__login--input" placeholder="Enter username"
                                                        type="text" name="name" value="<?php echo e(Auth::user()->name); ?>"
                                                        readonly id="username">
                                                </label>
                                                <label>
                                                    <input class="account__login--input" placeholder="Enter new password"
                                                        type="password" name="password" id="password">
                                                </label>
                                                <label>
                                                    <input class="account__login--input"
                                                        placeholder="Enter new confirm Password" type="password"
                                                        name="password_confirmation" id="confirm_password">
                                                </label>

                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="show_pass" class="confirm_show_pass">
                                                    <label class="form-check-label" for="show_pass">
                                                        Show Password
                                                    </label>
                                                </div>

                                                
                                                
                                                <div class="d-flex justify-content-space-between align-items-center gap-2">
                                                    <button class="account__login--btn primary__btn" type="button"
                                                        id="edit_btn">Edit Username</button>
                                                    <button class="account__login--btn primary__btn" type="submit"
                                                        id="update_btn">Update</button>
                                                </div>
                                                </di>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!-- my account section end -->

    <?php echo $__env->make('front.partials.shipping_sec', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front.front-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\sajjel\laragon\www\carpartslb.com\resources\views/customer/dashboard.blade.php ENDPATH**/ ?>