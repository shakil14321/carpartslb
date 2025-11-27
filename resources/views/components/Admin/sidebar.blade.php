 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">
     <!-- sidebar: style can be found in sidebar.less -->
     <section class="sidebar">
         <!-- Sidebar user panel -->
         <div class="user-panel">
             <div class="pull-left image">
                 <img src="{{ Auth::user()->user_image ? asset('public/images/users/' . Auth::user()->user_image) : asset('public/assets/admin/dist/img/avatar5.png') }}"
                     class="img-circle" alt="User Image" />
             </div>
             <div class="pull-left info">
                 <p>{{ ucwords(Auth::user()->name) }}</p>

                 @if (Auth::check())
                     <p><i class="fa fa-circle text-success"></i> Online</p>
                 @else
                     <p><i class="fa fa-circle text-danger"></i> Offline</p>
                 @endif
             </div>
         </div>

         <!-- sidebar menu: : style can be found in sidebar.less -->
         <ul class="sidebar-menu">
             <li class="header">MAIN NAVIGATION</li>
             <li
                 class="{{ request()->routeIs('dashboard') || request()->routeIs('authorDashboard.view') ? 'active' : '' }} treeview">
                 <a href="{{ Auth::user()->role == 'admin' ? route('dashboard') : route('authorDashboard.view') }}">
                     <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
                 </a>
             </li>
             <!-- Parts links -->
             <li class="treeview {{ request()->routeIs('product.*') ? 'menu-open active' : '' }}">
                 <a href="#">
                     <i class="fa fa-gavel"></i>
                     <span>Products</span>
                     <i class="fa fa-angle-left pull-right"></i>
                 </a>
                 <ul class="treeview-menu" style="{{ request()->routeIs('product.*') ? 'display: block;' : '' }}">
                     <li class="{{ request()->routeIs('product.index') ? 'active' : '' }}"><a
                             href="{{ route('product.index') }}">
                             <i class="fa fa-circle-o"></i> All Products</a>
                     </li>
                     <li class="{{ request()->routeIs('product.create') ? 'active' : '' }}"><a
                             href="{{ route('product.create') }}"><i class="fa fa-circle-o"></i> Add New</a></li>
                 </ul>
             </li>

             <!-- Parts types links -->
             <li class="treeview {{ request()->routeIs('type.*') ? 'menu-open active' : '' }}">
                 <a href="#">
                     <i class="fa  fa-filter"></i>
                     <span>Product Categories</span>
                     <i class="fa fa-angle-left pull-right"></i>
                 </a>
                 <ul class="treeview-menu" style="{{ request()->routeIs('type.*') ? 'display: block;' : '' }}">
                     <li class="{{ request()->routeIs('type.index') ? 'active' : '' }}"><a
                             href="{{ route('type.index') }}"><i class="fa fa-circle-o"></i> All Categories</a></li>
                     <li class="{{ request()->routeIs('type.create') ? 'active' : '' }}"><a
                             href="{{ route('type.create') }}"><i class="fa fa-circle-o"></i> Add New</a></li>
                 </ul>
             </li>

             <!-- Media links -->
             <li
                 class="treeview {{ request()->routeIs('featureImage.*') || request()->routeIs('galleryImage.*') || request()->routeIs('categoryImage.*') || request()->routeIs('brandImage.*') || request()->routeIs('modelImage.*') || request()->routeIs('userImage.*') ? 'menu-open active' : '' }}">
                 <a href="#">
                     <i class="fa fa-picture-o"></i>
                     <span>Media</span>
                     <i class="fa fa-angle-left pull-right"></i>
                 </a>
                 <ul class="treeview-menu"
                     style="{{ request()->routeIs('featureImage.*') || request()->routeIs('galleryImage.*') || request()->routeIs('categoryImage.*') || request()->routeIs('brandImage.*') || request()->routeIs('modelImage.*') || request()->routeIs('userImage.*') ? 'display: block;' : '' }}">
                     <li class="{{ request()->routeIs('featureImage.view') ? 'active' : '' }}"><a
                             href="{{ route('featureImage.view') }}"><i class="fa fa-circle-o"></i> Feature Images</a>
                     </li>
                     <li class="{{ request()->routeIs('galleryImage.view') ? 'active' : '' }}"><a
                             href="{{ route('galleryImage.view') }}"><i class="fa fa-circle-o"></i> Gallery Images</a>
                     </li>
                     <li class="{{ request()->routeIs('categoryImage.view') ? 'active' : '' }}"><a
                             href="{{ route('categoryImage.view') }}"><i class="fa fa-circle-o"></i> Categories
                             Images</a></li>
                     <li class="{{ request()->routeIs('brandImage.view') ? 'active' : '' }}"><a
                             href="{{ route('brandImage.view') }}"><i class="fa fa-circle-o"></i> Brand Images</a></li>
                     <li class="{{ request()->routeIs('modelImage.view') ? 'active' : '' }}"><a
                             href="{{ route('modelImage.view') }}"><i class="fa fa-circle-o"></i> Model Images</a></li>
                     <li class="{{ request()->routeIs('userImage.view') ? 'active' : '' }}"><a
                             href="{{ route('userImage.view') }}"><i class="fa fa-circle-o"></i> User Images</a></li>
                 </ul>
             </li>

             <!-- Brands links -->
             <li class="treeview {{ request()->routeIs('brand.*') ? 'menu-open active' : '' }}">
                 <a href="#">
                     <i class="fa fa-bookmark"></i>
                     <span>Car Brands</span>
                     <i class="fa fa-angle-left pull-right"></i>
                 </a>
                 <ul class="treeview-menu" style="{{ request()->routeIs('brand.*') ? 'display: block;' : '' }}">
                     <li class="{{ request()->routeIs('brand.index') ? 'active' : '' }}"><a
                             href="{{ route('brand.index') }}"><i class="fa fa-circle-o"></i> All Brands</a></li>
                     <li class="{{ request()->routeIs('brand.create') ? 'active' : '' }}"><a
                             href="{{ route('brand.create') }}"><i class="fa fa-circle-o"></i> Add New</a></li>
                 </ul>
             </li>

             <!-- Part/Accessories Brands links -->
             <li class="treeview {{ request()->routeIs('part-brand.*') ? 'menu-open active' : '' }}">
                 <a href="#">
                     <i class="fa fa-tags"></i>
                     <span>Part Brands</span>
                     <i class="fa fa-angle-left pull-right"></i>
                 </a>
                 <ul class="treeview-menu" style="{{ request()->routeIs('part-brand.*') ? 'display: block;' : '' }}">
                     <li class="{{ request()->routeIs('part-brand.index') ? 'active' : '' }}"><a
                             href="{{ route('part-brand.index') }}"><i class="fa fa-circle-o"></i> All Part Brands</a>
                     </li>
                     <li class="{{ request()->routeIs('part-brand.create') ? 'active' : '' }}"><a
                             href="{{ route('part-brand.create') }}"><i class="fa fa-circle-o"></i> Add New</a></li>
                 </ul>
             </li>

             <!-- Models links -->
             <li class="treeview {{ request()->routeIs('model.*') ? 'menu-open active' : '' }}">
                 <a href="#">
                     <i class="fa fa-compass"></i>
                     <span>Models</span>
                     <i class="fa fa-angle-left pull-right"></i>
                 </a>
                 <ul class="treeview-menu" style="{{ request()->routeIs('model.*') ? 'display: block;' : '' }}">
                     <li class="{{ request()->routeIs('model.index') ? 'active' : '' }}"><a
                             href="{{ route('model.index') }}"><i class="fa fa-circle-o"></i> All Models</a></li>
                     <li class="{{ request()->routeIs('model.create') ? 'active' : '' }}"><a
                             href="{{ route('model.create') }}"><i class="fa fa-circle-o"></i> Add New</a></li>
                 </ul>
             </li>

             @if (Auth::check() && Auth::user()->role === 'admin')
                 <!-- Shipment links -->
                 <li
                     class="treeview {{ request()->routeIs('orderView.*') || request()->routeIs('reviewOrder.*') || request()->routeIs('processOrder.*') || request()->routeIs('deliverOrder.*') || request()->routeIs('completeOrder.*') || request()->routeIs('cancelOrders.*') ? 'menu-open active' : '' }}">
                     <a href="#">
                         <i class="fa  fa-truck"></i>
                         <span>Shipment</span>
                         <i class="fa fa-angle-left pull-right"></i>
                     </a>
                     <ul class="treeview-menu"
                         style="{{ request()->routeIs('orderView.*') || request()->routeIs('reviewOrder.*') || request()->routeIs('processOrder.*') || request()->routeIs('deliverOrder.*') || request()->routeIs('completeOrder.*') || request()->routeIs('cancelOrders.*') ? 'display: block;' : '' }}">
                         <li class="{{ request()->routeIs('orderView.admin') ? 'active' : '' }}"><a
                                 href="{{ route('orderView.admin') }}"><i class="fa fa-circle-o"></i> All Orders</a>
                         </li>
                         <li class="{{ request()->routeIs('reviewOrder.admin') ? 'active' : '' }}"><a
                                 href="{{ route('reviewOrder.admin') }}"><i class="fa fa-circle-o"></i> Review</a>
                         </li>
                         <li class="{{ request()->routeIs('processOrder.admin') ? 'active' : '' }}"><a
                                 href="{{ route('processOrder.admin') }}"><i class="fa fa-circle-o"></i>
                                 Processing</a>
                         </li>
                         <li class="{{ request()->routeIs('deliverOrder.admin') ? 'active' : '' }}"><a
                                 href="{{ route('deliverOrder.admin') }}"><i class="fa fa-circle-o"></i> Deliver</a>
                         </li>
                         <li class="{{ request()->routeIs('completeOrder.admin') ? 'active' : '' }}"><a
                                 href="{{ route('completeOrder.admin') }}"><i class="fa fa-circle-o"></i>
                                 Completed</a>
                         </li>
                         <li class="{{ request()->routeIs('cancelOrders.admin') ? 'active' : '' }}"><a
                                 href="{{ route('cancelOrders.admin') }}"><i class="fa fa-circle-o"></i> Cancel</a>
                         </li>
                     </ul>
                 </li>

                 <!-- Contact links -->
                 <li class="treeview {{ request()->routeIs('contact.*') ? 'menu-open active' : '' }}">
                     <a href="#">
                         <i class="fa  fa-book"></i>
                         <span>Contact</span>
                         <i class="fa fa-angle-left pull-right"></i>
                     </a>
                     <ul class="treeview-menu"
                         style="{{ request()->routeIs('contact.*') ? 'display: block;' : '' }}">
                         <li class="{{ request()->routeIs('contact.index') ? 'active' : '' }}"><a
                                 href="{{ route('contact.index') }}"><i class="fa fa-circle-o"></i> All Contacts</a>
                         </li>
                     </ul>
                 </li>

                 <!-- Users links -->
                 <li
                     class="treeview {{ request()->routeIs('user.*') || request()->routeIs('author.*') ? 'menu-open active' : '' }}">
                     <a href="#">
                         <i class="fa fa-group"></i>
                         <span>Users</span>
                         <i class="fa fa-angle-left pull-right"></i>
                     </a>
                     <ul class="treeview-menu"
                         style="{{ request()->routeIs('user.*') || request()->routeIs('author.*') ? 'display: block;' : '' }}">
                         <li class="{{ request()->routeIs('user.index') ? 'active' : '' }}"><a
                                 href="{{ route('user.index') }}"><i class="fa fa-circle-o"></i> Admin</a></li>
                         <li class="{{ request()->routeIs('author.view') ? 'active' : '' }}"><a
                                 href="{{ route('author.view') }}"><i class="fa fa-circle-o"></i> Author</a></li>
                         <li class="{{ request()->routeIs('user.create') ? 'active' : '' }}"><a
                                 href="{{ route('user.create') }}"><i class="fa fa-circle-o"></i> Add New</a></li>
                     </ul>
                 </li>


                 <!-- Customers links -->
                 <li class="treeview {{ request()->routeIs('cutomers.*') ? 'menu-open active' : '' }}">
                     <a href="#">
                         <i class="fa fa-group"></i>
                         <span>Customers</span>
                         <i class="fa fa-angle-left pull-right"></i>
                     </a>
                     <ul class="treeview-menu"
                         style="{{ request()->routeIs('cutomers.*') ? 'display: block;' : '' }}">
                         <li class="{{ request()->routeIs('cutomers.view') ? 'active' : '' }}"><a
                                 href="{{ route('cutomers.view') }}"><i class="fa fa-circle-o"></i> All customer</a>
                         </li>
                     </ul>
                 </li>

                 <!-- Reviews links -->
                 <li class="treeview {{ request()->routeIs('review.*') ? 'menu-open active' : '' }}">
                     <a href="#">
                         <i class="fa fa-comments"></i>
                         <span>Reviews</span>
                         <i class="fa fa-angle-left pull-right"></i>
                     </a>
                     <ul class="treeview-menu" style="{{ request()->routeIs('review.*') ? 'display: block;' : '' }}">
                         <li class="{{ request()->routeIs('review.index') ? 'active' : '' }}"><a
                                 href="{{ route('review.index') }}"><i class="fa fa-circle-o"></i> All Reviews</a>
                         </li>
                     </ul>
                 </li>

                 <!-- Site setting links -->
                 <li class="treeview {{ request()->routeIs('setting.*') ? 'menu-open active' : '' }}">
                     <a href="#">
                         <i class="fa fa-gear"></i>
                         <span>Setting</span>
                         <i class="fa fa-angle-left pull-right"></i>
                     </a>
                     <ul class="treeview-menu"
                         style="{{ request()->routeIs('setting.*') ? 'display: block;' : '' }}">
                         <li class="{{ request()->routeIs('setting.logo') ? 'active' : '' }}"><a
                                 href="{{ route('setting.logo') }}"><i class="fa fa-circle-o"></i> Logo</a></li>
                         <li class="{{ request()->routeIs('setting.homeSlider') ? 'active' : '' }}"><a
                                 href="{{ route('setting.homeSlider') }}"><i class="fa fa-circle-o"></i> Home
                                 Slider</a></li>
                         <li class="{{ request()->routeIs('setting.announcement') ? 'active' : '' }}"><a
                                 href="{{ route('setting.announcement') }}"><i class="fa fa-circle-o"></i>
                                 Announcement</a></li>
                         <li class="{{ request()->routeIs('setting.menu') ? 'active' : '' }}"><a
                                 href="{{ route('setting.menu') }}"><i class="fa fa-circle-o"></i> Menu</a></li>
                         <li class="{{ request()->routeIs('setting.brand') ? 'active' : '' }}"><a
                                 href="{{ route('setting.brand') }}"><i class="fa fa-circle-o"></i> Brand</a></li>
                         <li class="{{ request()->routeIs('setting.verification') ? 'active' : '' }}"><a
                                 href="{{ route('setting.verification') }}"><i class="fa fa-circle-o"></i>
                                 Verification</a></li>
                         <li class="{{ request()->routeIs('setting.homeText') ? 'active' : '' }}">
                             <a href="{{ route('setting.homeText') }}">
                                 <i class="fa fa-circle-o"></i> Home Page Text
                             </a>
                         </li>
                     </ul>
                 </li>

                 <!-- import export -->
                 <li
                     class="treeview {{ request()->routeIs('parts.import') || request()->routeIs('part-types.import') || request()->routeIs('brands.import') || request()->routeIs('partBrands.import') || request()->routeIs('models.import') ? 'menu-open active' : '' }}">
                     <a href="#">
                         <i class="fa fa-refresh"></i>
                         <span>Import/Export</span>
                         <i class="fa fa-angle-left pull-right"></i>
                     </a>
                     <ul class="treeview-menu"
                         style="{{ request()->routeIs('parts.import') || request()->routeIs('part-types.import') || request()->routeIs('brands.import') || request()->routeIs('partBrands.import') || request()->routeIs('models.import') ? 'display: block;' : '' }}">
                         <li class="{{ request()->routeIs('parts.import') ? 'active' : '' }}"><a
                                 href="{{ route('parts.import') }}"><i class="fa fa-circle-o"></i> Import
                                 Products</a>
                         </li>
                         <li class="{{ request()->routeIs('part-types.import') ? 'active' : '' }}"><a
                                 href="{{ route('part-types.import') }}"><i class="fa fa-circle-o"></i> Import Part
                                 Types</a>
                         </li>
                         <li class="{{ request()->routeIs('brands.import') ? 'active' : '' }}"><a
                                 href="{{ route('brands.import') }}"><i class="fa fa-circle-o"></i> Import Car
                                 Brands</a></li>
                         <li class="{{ request()->routeIs('partBrands.import') ? 'active' : '' }}"><a
                                 href="{{ route('partBrands.import') }}"><i class="fa fa-circle-o"></i> Import Parts
                                 Brands</a></li>
                         <li class="{{ request()->routeIs('models.import') ? 'active' : '' }}"><a
                                 href="{{ route('models.import') }}"><i class="fa fa-circle-o"></i> Import
                                 Models</a>
                         </li>
                 </li>
             @endif

             <!-- Cache links -->
             <li class="treeview {{ request()->routeIs('cache') ? 'menu-open active' : '' }}">
                 <a href="#">
                     <i class="fa fa-tasks"></i>
                     <span>Cache Setting</span>
                     <i class="fa fa-angle-left pull-right"></i>
                 </a>
                 <ul class="treeview-menu" style="{{ request()->routeIs('cache') ? 'display: block;' : '' }}">
                     <li class="{{ request()->routeIs('cache') ? 'active' : '' }}"><a
                             href="{{ route('cache') }}"><i class="fa fa-circle-o"></i> Cache</a></li>
                 </ul>
             </li>

             {{--
            <!-- Posts links -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Posts</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('post.index') }}"><i class="fa fa-circle-o"></i> All Posts</a></li>
                    <li><a href="{{ route('post.create') }}"><i class="fa fa-circle-o"></i> Add New</a></li>
                </ul>
            </li> --}}
             {{--
            <!-- Posts categories -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Posts Categories</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('category.index') }}"><i class="fa fa-circle-o"></i> All Categories</a></li>
                    <li><a href="{{ route('category.create') }}"><i class="fa fa-circle-o"></i> Add New</a></li>
                </ul>
            </li> --}}
         </ul>
     </section>
     <!-- /.sidebar -->
 </aside>
