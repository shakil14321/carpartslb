<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger main-danger notic_bar">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <div class="main-flex">
                        <h3 class="box-title">Add New Car Product</h3>
                        <a href="<?php echo e(route('product.index')); ?>" class="btn btn-primary btn-sm">All Products</a>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?php echo e(route('product.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="box-body">
                            <!-- product name input -->
                            <div class="form-group">
                                <label for="input-title">Product Name*</label>
                                <input type="text" class="form-control brand-name" id="input-title"
                                    placeholder="Enter car product name" name="title" value="<?php echo e(old('title')); ?>">
                            </div>

                            <!-- product slug input -->
                            <div class="input-group">
                                <input type="text" class="form-control" id="input-slug" placeholder="Slug will generate"
                                    name="slug" value="<?php echo e(old('slug')); ?>" readonly>
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-warning" id="slug-edit-button">Edit</button>
                                    <button type="button" class="btn btn-success" id="slug-edit-save-button">Save</button>
                                </div>
                            </div>

                            <!-- Product description -->
                            <section class="content">

                                <div class='row'>
                                    <label for="brandName">Product Description (Optional)</label>
                                    <div class='col-md-12'>
                                        <div class='box'>
                                            <div class='box-header'>
                                                <!-- tools box -->
                                                <div class="pull-right box-tools">
                                                    <button class="btn btn-default btn-sm" data-widget='collapse'
                                                        data-toggle="tooltip" title="Collapse"><i
                                                            class="fa fa-minus"></i></button>
                                                </div><!-- /. tools -->
                                            </div><!-- /.box-header -->
                                            <div class='box-body pad'>

                                                <textarea class="textarea summernote" name="description"><?php echo e(old('description')); ?></textarea>

                                            </div>
                                        </div>
                                    </div><!-- /.col-->
                                </div><!-- ./row -->
                            </section><!-- /.Product description -->

                            <!-- Product short description -->
                            <section class="content">

                                <div class='row'>
                                    <label for="brandName">Product short Description (Optional)</label>
                                    <div class='col-md-12'>
                                        <div class='box'>
                                            <div class='box-header'>
                                                <!-- tools box -->
                                                <div class="pull-right box-tools">
                                                    <button class="btn btn-default btn-sm" data-widget='collapse'
                                                        data-toggle="tooltip" title="Collapse"><i
                                                            class="fa fa-minus"></i></button>
                                                </div><!-- /. tools -->
                                            </div><!-- /.box-header -->
                                            <div class='box-body pad'>

                                                <textarea class="textarea summernote" name="short_description"><?php echo e(old('short_description')); ?></textarea>

                                            </div>
                                        </div>
                                    </div><!-- /.col-->
                                </div><!-- ./row -->
                            </section><!-- /.Product short description -->

                            <!-- Add favourite product input -->
                            <div class="form-group">
                                <div class="checkbox">
                                    <h4 class="stock-heading">Product is favourite?</h4>
                                    <label for="fav-product">
                                        <!-- hidden input ensures "0" is sent when checkbox is unchecked -->
                                        <input type="hidden" name="fav_product" value="0">

                                        <!-- checkbox sends "1" when checked -->
                                        <input type="checkbox" id="fav-product" name="fav_product" value="1"
                                            <?php echo e(old('fav_product', $product->fav_product ?? false) ? 'checked' : ''); ?>>
                                        Top / Favourite
                                    </label>
                                </div>
                            </div>


                            <!-- Stock unit input -->
                            <div class="form-group">
                                <label for="input-sku">Product SKU*</label>
                                <input type="text" class="form-control pro-sku" id="input-sku"
                                    placeholder="Enter stock unit" name="sku" value="<?php echo e(old('sku')); ?>">
                            </div>

                            <!-- Part Number input -->
                            <div class="form-group">
                                <label for="input-partNumber">Product Part Number*</label>
                                <input type="text" class="form-control part-number" id="input-partNumber"
                                    placeholder="Enter part number" name="part_number" value="<?php echo e(old('part_number')); ?>">
                            </div>

                            <!-- Vin code input -->
                            <div class="form-group">
                                <label for="input-vinCode">Product Vin Code</label>
                                <input type="text" class="form-control vin-code" id="input-vinCode"
                                    placeholder="Enter vin code" name="vin_code" value="<?php echo e(old('vin_code')); ?>">
                            </div>

                            <!-- Product original price input -->
                            <div class="form-group">
                                <label for="input-originalPrice">Product Price*</label>
                                <input type="number" class="form-control orig-price" id="input-originalPrice"
                                    placeholder="Enter product price" name="original_price"
                                    value="<?php echo e(old('original_price')); ?>">
                            </div>

                            <!-- Product sale price input -->
                            <div class="form-group">
                                <label for="input-salePrice">Product Sale Price*</label>
                                <input type="number" class="form-control sale-price-input" id="input-salePrice"
                                    placeholder="Enter product sale price" name="sale_price"
                                    value="<?php echo e(old('sale_price')); ?>">
                            </div>

                            <!-- Types dropdown -->
                            <div class="form-group">
                                <label for="car-brands">Choose Category</label>
                                <select class="form-control" name="part_type_id" id="car-brands">
                                    <option disabled <?php echo e(old('part_type_id') ? '' : 'selected'); ?>>Choose one Category
                                    </option>
                                    <?php $__currentLoopData = $partTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($partType->id); ?>"
                                            <?php echo e((old('part_type_id') ?? ($selectedPartType->id ?? null)) == $partType->id ? 'selected' : ''); ?>>
                                            <?php echo e($partType->title ?? ''); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <!-- Part Brand Dropdown -->
                            <div class="form-group">
                                <label for="brand_id">Part Brand</label>
                                <select class="form-control" id="brand_id" name="car_brand_id">
                                    <option selected disabled>Select Part Brand</option>
                                    <?php $__currentLoopData = $partBrands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partBrand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($partBrand->id); ?>"><?php echo e($partBrand->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <!-- Brand Dropdown -->
                            <div class="form-group">
                                <label for="brand_id">Car Brand</label>
                                <select class="form-control" id="brand_id" name="car_brand_id">
                                    <option selected disabled>Select Car Brand</option>
                                    <?php $__currentLoopData = $carBrands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $carBrand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($carBrand->id); ?>"><?php echo e($carBrand->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>


                            <!-- Model Dropdown -->
                            <div class="form-group">
                                <label for="model_id">Model</label>
                                <select class="form-control" id="model_id" name="car_model_id">
                                    <option selected disabled>Select Brand First</option>
                                </select>
                            </div>


                            <!-- Year Input -->
                            <div class="form-group">
                                <label>Model Year</label>
                                <input type="number" class="form-control" id="year_input" name="year" readonly>
                            </div>

                            <!-- Stock radio in out -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <h4 class="stock-heading">Stock</h4>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="stock_type" id="stock-type-input-in"
                                                    value="in" />
                                                Available
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="stock_type" id="stock-type-input-out"
                                                    value="out" />
                                                Out
                                            </label>
                                        </div>
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->
                            </div>

                            <!-- Stock quantity Input -->
                            <div class="form-group">
                                <label for="stock_quantity_input">Stock Quantity</label>
                                <input type="number" class="form-control" id="stock_quantity_input"
                                    name="stock_quantity" placeholder="Enter stock quantity" min="0"
                                    value="<?php echo e(old('stock_quantity')); ?>">
                            </div>

                            <!-- Product image Input -->
                            <div class="form-group">
                                <label for="imageFile">Product Image (Optional)</label>
                                <input type="file" id="imageFile" name="feature_image">
                                <br>
                                <img src="<?php echo e(old('feature_image') ? asset('public/images/parts/feature' . old('feature_image')) : asset('public/images/brands/demo.png')); ?>"
                                    alt="" class="edit-add-image" id="brandImagePreview">
                            </div>

                            <!-- Product image gallery Input -->
                            <div class="form-group">
                                <label for="imageGalleryFile">Product Image Gallery (Optional)</label>
                                <input type="file" id="imageGalleryFile" name="gallery_images[]" multiple
                                    accept="image/*">

                                <!-- Preview container -->
                                <div id="galleryPreview">
                                </div>
                            </div>

                            <h2>Seo Details</h2>

                            <!-- seo title input -->
                            <div class="form-group">
                                <label for="seoTitle">Seo Title</label>
                                <input type="text" class="form-control seo_title" id="seoTitle"
                                    placeholder="Write a short and catchy meta title (about 60 characters)..."
                                    name="meta_title" value="<?php echo e(old('meta_title')); ?>">
                            </div>

                            <!-- seo description input -->
                            <div class="form-group">
                                <label for="seoDescription">Seo Description</label>
                                <textarea class="form-control seo_description" id="seoDescription" name="meta_description"
                                    placeholder="Write a short and catchy meta description (about 160 characters)..."><?php echo e(old('meta_description')); ?></textarea>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div> <!-- /.row -->
    </section><!-- /.content -->

    <script>
        // Models grouped by brand from controller
        const modelsByBrand = <?php echo json_encode($modelsByBrand, 15, 512) ?>;

        const brandDropdown = document.getElementById('brand_id');
        const modelDropdown = document.getElementById('model_id');
        const yearInput = document.getElementById('year_input');

        brandDropdown.addEventListener('change', function() {
            const brandId = this.value;
            modelDropdown.innerHTML = '<option selected disabled>Select Model</option>';

            if (modelsByBrand[brandId]) {
                modelsByBrand[brandId].forEach(function(model) {
                    const option = document.createElement('option');
                    option.value = model.id;
                    option.text = model.title;
                    option.setAttribute('data-year', model.year);
                    modelDropdown.appendChild(option);
                });
            }

            yearInput.value = ''; // reset year
        });

        modelDropdown.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            yearInput.value = selectedOption.getAttribute('data-year') || '';
        });
    </script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\sajjel\laragon\www\carpartslb.com\resources\views/admin/product/create.blade.php ENDPATH**/ ?>