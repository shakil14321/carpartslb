<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FwiProduct extends Model
{
    protected $fillable = [
        'unique_id',
        'source_product_id',
        'product_name',
        'slug',
        'description',
        'meta_description',
        'image',
        'source_price',
        'bundle_price',
        'min_quantity',
        'brand_name',
        'model_name',
        'source_updated_at',
        'synced_at',
        'imported',
        'profit_margin',
        'cat_id',
        'sub_cat_id',
        'source_cat_id',
        'source_sub_cat_id',
        'source_cat_name',
        'source_sub_cat_name',
    ];
}
