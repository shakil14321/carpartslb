<!-- header -->
<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo e(route('dashboard')); ?>" class="logo"><b>Autos</b>Admin</a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
         
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">                
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs"><?php echo e(ucwords(Auth::user()->name ?? ' ')); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header" style="height:110px;">
                            <img src="<?php echo e(Auth::user()->user_image ? asset('public/images/users/' . Auth::user()->user_image) : asset('public/assets/admin/dist/img/avatar5.png')); ?>"
                                class="img-circle" alt="User Image" />                           
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                 <?php if(auth()->check()): ?>
                                    <a href="<?php echo e(route('user.edit', auth()->user()->id)); ?>" class="btn btn-default btn-flat">
                                      Profile
                                    </a>
                                  <?php endif; ?>
                            </div>
                            <div class="pull-right">
                                <form action="<?php echo e(route('logout')); ?>" method="post">
                                    <?php echo csrf_field(); ?>                                    
                                    <button class="btn btn-default btn-flat" type="submit" class="logout_btn">Log Out</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    
</header><?php /**PATH E:\sajjel\laragon\www\carpartslb.com\resources\views/components/admin/header.blade.php ENDPATH**/ ?>