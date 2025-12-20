<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StandardShipping extends Model
{
    protected $table = 'standard_shippings';

    protected $fillable = [
        'title',
        'cost',
        'status',
    ];
}
