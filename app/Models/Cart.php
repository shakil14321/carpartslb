<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
     protected $fillable = [
        'user_id', 'product_id', 'title', 'slug', 'sku', 'part_number',
        'feature_image', 'original_price', 'sale_price', 'quantity', 'session_id'
    ];


    public function product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }

    // Optionally: cart belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
