@extends('layouts.admin.admin-layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Add FWI Product</h1>
        </section>

        <section class="content">

            <form method="POST" action="{{ route('fwi-products.store',  $fwiProduct->source_product_id) }}">
                @csrf

                <div class="box box-primary">
                    <div class="box-body">

                        <h4>{{ $fwiProduct->product_name }}</h4>

                        @if($fwiProduct->image)
                            <img src="{{ $fwiProduct->image }}" width="120">
                        @endif

                        <hr>

                        <div class="form-group">
                            <label>Source Price</label>
                            <input type="text" class="form-control" value="{{ $fwiProduct->source_price }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            <select name="cat_id" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ optional($selectedCategory)->id == $category->id ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Sub Category</label>
                            <select name="sub_cat_id" class="form-control">
                                <option value="">Select Sub Category</option>
                                @foreach($subCategories as $subCategory)
                                    <option value="{{ $subCategory->id }}"
                                        {{ optional($selectedSubCategory)->id == $subCategory->id ? 'selected' : '' }}>
                                        {{ $subCategory->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <label>Brand</label>--}}
{{--                            <select name="brand_id" class="form-control">--}}
{{--                                <option value="">Select Brand</option>--}}
{{--                                @foreach($brands as $brand)--}}
{{--                                    <option value="{{ $brand->id }}">--}}
{{--                                        {{ $brand->name ?? $brand->brand ?? $brand->title ?? $brand->id }}--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <label>Model</label>--}}
{{--                            <select name="model_id" class="form-control">--}}
{{--                                <option value="">Select Model</option>--}}
{{--                                @foreach($models as $model)--}}
{{--                                    <option value="{{ $model->id }}">--}}
{{--                                        {{ $model->name ?? $model->model_name ?? $model->title ?? $model->id }}--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

                        <div class="form-group">
                            <label>Profit Margin %</label>
                            <input type="number" step="0.01" name="profit_margin" class="form-control" value="0" required>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">
                            Submit To Products
                        </button>

                    </div>
                </div>

            </form>

        </section>
    </div>
@endsection
