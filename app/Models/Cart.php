<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
     protected $fillable = [
        'user_id', 'product_id', 'title', 'slug', 'sku', 'part_number',
        'feature_image', 'original_price', 'sale_price', 'quantity'
    ];
}
