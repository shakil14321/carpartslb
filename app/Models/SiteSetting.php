<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $table = 'site_setting';

    protected $fillable = [
        'site_logo',
        'notice_bar',
        'menu_items',
        'carousel_image_one',
        'carousel_image_two',
        'carousel_image_three',
        'brand_quantity',
        'google_verification',
    ];

    protected $casts = [
        'menu_items' => 'array', // JSON array ko array mein convert karega
    ];
}
