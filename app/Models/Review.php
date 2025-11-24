<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    
    protected $fillable = [
        'username',
        'email',
        'user_image',
        'product_id',
        'product_title',
        'product_url',
        'rating',
        'review',
        'reply',
        'reply_admin_name'
    ];
}
