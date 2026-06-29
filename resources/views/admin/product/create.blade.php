@extends('layouts.admin.admin-layout')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    @if ($errors->any())
                        <div class="alert alert-danger main-danger notic_bar">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="main-flex">
                        <h3 class="box-title">Add New Car Product</h3>
                        <a href="{{ route('product.index') }}" class="btn btn-primary btn-sm">All Products</a>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <!-- product name input -->
                            <div class="form-group">
                                <label for="input-title">Product Name*</label>
                                <input type="text" class="form-control brand-name" id="input-title"
                                    placeholder="Enter car product name" name="title" value="{{ old('title') }}">
                            </div>

                            <!-- product slug input -->
                            <div class="input-group">
                                <input type="text" class="form-control" id="input-slug" placeholder="Slug will generate"
                                    name="slug" value="{{ old('slug') }}" readonly>
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

                                                <textarea class="textarea summernote" name="description">{{ old('description') }}</textarea>

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

                                                <textarea class="textarea summernote" name="short_description">{{ old('short_description') }}</textarea>

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
                                            {{ old('fav_product', $product->fav_product ?? false) ? 'checked' : '' }}>
                                        Top / Favourite
                                    </label>
                                </div>
                            </div>


                            <!-- Stock unit input -->
                            <div class="form-group">
                                <label for="input-sku">Product SKU*</label>
                                <input type="text" class="form-control pro-sku" id="input-sku"
                                    placeholder="Enter stock unit" name="sku" value="{{ old('sku') }}">
                            </div>

                            <!-- Part Number input -->
                            <div class="form-group">
                                <label for="input-partNumber">Product Part Number*</label>
                                <input type="text" class="form-control part-number" id="input-partNumber"
                                    placeholder="Enter part number" name="part_number" value="{{ old('part_number') }}">
                            </div>

                            <!-- Vin code input -->
                            <div class="form-group">
                                <label for="input-vinCode">Product Vin Code</label>
                                <input type="text" class="form-control vin-code" id="input-vinCode"
                                    placeholder="Enter vin code" name="vin_code" value="{{ old('vin_code') }}">
                            </div>

                            <!-- Product original price input -->
                            <div class="form-group">
                                <label for="input-originalPrice">Product Price*</label>
                                <input type="number" class="form-control orig-price" id="input-originalPrice"
                                    placeholder="Enter product price" name="original_price"
                                    value="{{ old('original_price') }}" step=".01">
                            </div>

                            <!-- Product sale price input -->
                            <div class="form-group">
                                <label for="input-salePrice">Product Sale Price*</label>
                                <input type="number" class="form-control sale-price-input" id="input-salePrice"
                                    placeholder="Enter product sale price" name="sale_price"
                                    value="{{ old('sale_price') }}" step="0.01">
                            </div>

                            <!-- Types dropdown -->
                            <div class="form-group">
                                <label for="car-brands">Choose Category</label>
                                <select class="form-control" name="part_type_id" id="car-brands">
                                    <option disabled {{ old('part_type_id') ? '' : 'selected' }}>Choose one Category
                                    </option>
                                    @foreach ($partTypes as $partType)
                                        <option value="{{ $partType->id }}"
                                            {{ (old('part_type_id') ?? ($selectedPartType->id ?? null)) == $partType->id ? 'selected' : '' }}>
                                            {{ $partType->title ?? '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Part Brand Dropdown -->
                            <div class="form-group">
                                <label for="brand_id">Part Brand</label>
                                <select class="form-control" id="brand_id" name="car_brand_id">
                                    <option selected disabled>Select Part Brand</option>
                                    @foreach ($partBrands as $partBrand)
                                        <option value="{{ $partBrand->id }}">{{ $partBrand->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Brand Dropdown -->
                            <div class="form-group">
                                <label for="brand_id">Car Brand</label>
                                <select class="form-control" id="brand_id" name="car_brand_id">
                                    <option selected disabled>Select Car Brand</option>
                                    @foreach ($carBrands as $carBrand)
                                        <option value="{{ $carBrand->id }}">{{ $carBrand->title }}</option>
                                    @endforeach
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
                                    value="{{ old('stock_quantity') }}">
                            </div>

                            <!-- Product image Input -->
                            <div class="form-group">
                                <label for="imageFile">Product Image (Optional)</label>
                                <input type="file" id="imageFile" name="feature_image">
                                <br>
                                <img src="{{ old('feature_image') ? asset('images/parts/feature' . old('feature_image')) : asset('images/brands/demo.png') }}"
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
                                    name="meta_title" value="{{ old('meta_title') }}">
                            </div>

                            <!-- seo description input -->
                            <div class="form-group">
                                <label for="seoDescription">Seo Description</label>
                                <textarea class="form-control seo_description" id="seoDescription" name="meta_description"
                                    placeholder="Write a short and catchy meta description (about 160 characters)...">{{ old('meta_description') }}</textarea>
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
        const modelsByBrand = @json($modelsByBrand);

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



@endsection
