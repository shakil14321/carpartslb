<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistanceShipping extends Model
{
     use HasFactory;

    protected $table = 'distance_shippings'; 

    protected $fillable = [
        'per_km_price',
        'min_cost',
        'max_cost'
    ];
}
