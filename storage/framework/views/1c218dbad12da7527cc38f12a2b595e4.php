 <!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo e(Auth::user()->user_image ? asset('public/images/users/' . Auth::user()->user_image) : asset('public/assets/admin/dist/img/avatar5.png')); ?>"
                    class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?php echo e(ucwords(Auth::user()->name)); ?></p>

                <?php if(Auth::check()): ?>
                    <p><i class="fa fa-circle text-success"></i> Online</p>
                <?php else: ?>
                    <p><i class="fa fa-circle text-danger"></i> Offline</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
                <a href="<?php echo e(Auth::user()->role == 'admin' ? route('dashboard') : route('authorDashboard.view')); ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
                </a>
            </li>
            <!-- Parts links -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gavel"></i>
                    <span>Products</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(route('product.index')); ?>"><i class="fa fa-circle-o"></i> All Products</a></li>
                    <li><a href="<?php echo e(route('product.create')); ?>"><i class="fa fa-circle-o"></i> Add New</a></li>
                </ul>
            </li>
            
            <!-- Parts types links -->
            <li class="treeview">
                <a href="#">
                    <i class="fa  fa-filter"></i>
                    <span>Product Categories</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(route('type.index')); ?>"><i class="fa fa-circle-o"></i> All Categories</a></li>
                    <li><a href="<?php echo e(route('type.create')); ?>"><i class="fa fa-circle-o"></i> Add New</a></li>
                </ul>
            </li>
            
            <!-- Media links -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-picture-o"></i>
                    <span>Media</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(route('featureImage.view')); ?>"><i class="fa fa-circle-o"></i> Feature Images</a></li>
                    <li><a href="<?php echo e(route('galleryImage.view')); ?>"><i class="fa fa-circle-o"></i> Gallery Images</a></li>
                    <li><a href="<?php echo e(route('categoryImage.view')); ?>"><i class="fa fa-circle-o"></i> Categories Images</a></li>
                    <li><a href="<?php echo e(route('brandImage.view')); ?>"><i class="fa fa-circle-o"></i> Brand Images</a></li>
                    <li><a href="<?php echo e(route('modelImage.view')); ?>"><i class="fa fa-circle-o"></i> Model Images</a></li>
                    <li><a href="<?php echo e(route('userImage.view')); ?>"><i class="fa fa-circle-o"></i> User Images</a></li>
                </ul>
            </li>

            <!-- Brands links -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bookmark"></i>
                    <span>Car Brands</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(route('brand.index')); ?>"><i class="fa fa-circle-o"></i> All Brands</a></li>
                    <li><a href="<?php echo e(route('brand.create')); ?>"><i class="fa fa-circle-o"></i> Add New</a></li>
                </ul>
            </li>

            <!-- Part/Accessories Brands links -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-tags"></i>
                    <span>Part Brands</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(route('part-brand.index')); ?>"><i class="fa fa-circle-o"></i> All Part Brands</a>
                    </li>
                    <li><a href="<?php echo e(route('part-brand.create')); ?>"><i class="fa fa-circle-o"></i> Add New</a></li>
                </ul>
            </li>

            <!-- Models links -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-compass"></i>
                    <span>Models</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(route('model.index')); ?>"><i class="fa fa-circle-o"></i> All Models</a></li>
                    <li><a href="<?php echo e(route('model.create')); ?>"><i class="fa fa-circle-o"></i> Add New</a></li>
                </ul>
            </li>
            
            <?php if(Auth::check() && Auth::user()->role === 'admin'): ?>
            <!-- Shipment links -->
            <li class="treeview">
                <a href="#">
                    <i class="fa  fa-truck"></i>
                    <span>Shipment</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(route('orderView.admin')); ?>"><i class="fa fa-circle-o"></i> All Orders</a></li>
                    <li><a href="<?php echo e(route('reviewOrder.admin')); ?>"><i class="fa fa-circle-o"></i> Review</a></li>
                    <li><a href="<?php echo e(route('processOrder.admin')); ?>"><i class="fa fa-circle-o"></i> Processing</a></li>
                    <li><a href="<?php echo e(route('deliverOrder.admin')); ?>"><i class="fa fa-circle-o"></i> Deliver</a></li>
                    <li><a href="<?php echo e(route('completeOrder.admin')); ?>"><i class="fa fa-circle-o"></i> Completed</a></li>
                    <li><a href="<?php echo e(route('cancelOrders.admin')); ?>"><i class="fa fa-circle-o"></i> Cancel</a></li>
                </ul>
            </li>
            
            <!-- Contact links -->
            <li class="treeview">
                <a href="#">
                    <i class="fa  fa-book"></i>
                    <span>Contact</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(route('contact.index')); ?>"><i class="fa fa-circle-o"></i> All Contacts</a></li>
                </ul>
            </li>
            
            <!-- Users links -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-group"></i>
                    <span>Users</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(route('user.index')); ?>"><i class="fa fa-circle-o"></i> Admin</a></li>
                    <li><a href="<?php echo e(route('author.view')); ?>"><i class="fa fa-circle-o"></i> Author</a></li>
                    <li><a href="<?php echo e(route('user.create')); ?>"><i class="fa fa-circle-o"></i> Add New</a></li>
                </ul>
            </li>
            
            
            <!-- Customers links -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-group"></i>
                    <span>Customers</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(route('cutomers.view')); ?>"><i class="fa fa-circle-o"></i> All customer</a></li>
                </ul>
            </li>
            
            <!-- Reviews links -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-comments"></i>
                    <span>Reviews</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(route('review.index')); ?>"><i class="fa fa-circle-o"></i> All Reviews</a></li>
                </ul>
            </li>
            
            <!-- Site setting links -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gear"></i>
                    <span>Setting</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(route('setting.logo')); ?>"><i class="fa fa-circle-o"></i> Logo</a></li>
                    <li><a href="<?php echo e(route('setting.homeSlider')); ?>"><i class="fa fa-circle-o"></i> Home Slider</a></li>
                    <li><a href="<?php echo e(route('setting.announcement')); ?>"><i class="fa fa-circle-o"></i> Announcement</a></li>
                    <li><a href="<?php echo e(route('setting.menu')); ?>"><i class="fa fa-circle-o"></i> Menu</a></li>
                    <li><a href="<?php echo e(route('setting.brand')); ?>"><i class="fa fa-circle-o"></i> Brand</a></li>
                    <li><a href="<?php echo e(route('setting.verification')); ?>"><i class="fa fa-circle-o"></i> Verification</a></li>
                </ul>
            </li>
            
            <!-- import export -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-refresh"></i>
                    <span>Import/Export</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(route('parts.import')); ?>"><i class="fa fa-circle-o"></i> Import Products</a></li>
                    <li><a href="<?php echo e(route('part-types.import')); ?>"><i class="fa fa-circle-o"></i> Import Part Types</a>
                    </li>
                    <li><a href="<?php echo e(route('brands.import')); ?>"><i class="fa fa-circle-o"></i> Import Car Brands</a></li>
                    <li><a href="<?php echo e(route('partBrands.import')); ?>"><i class="fa fa-circle-o"></i> Import Parts
                            Brands</a></li>
                    <li><a href="<?php echo e(route('models.import')); ?>"><i class="fa fa-circle-o"></i> Import Models</a></li>
            </li>
            <?php endif; ?>
            
            <!-- Cache links -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-tasks"></i>
                    <span>Cache Setting</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(route('cache')); ?>"><i class="fa fa-circle-o"></i> Cache</a></li>
                </ul>
            </li>

            
            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<?php /**PATH /home/u770170027/domains/carpartslb.com/public_html/resources/views/components/Admin/sidebar.blade.php ENDPATH**/ ?>