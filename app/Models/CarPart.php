<?php

namespace App\Models;

use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\CarPartType;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarPart extends Model
{
    Use HasFactory;

    protected $fillable = [
        'car_brand_id',
        'car_model_id',
        'part_type_id',
        'part_brand_id',
        'title',
        'slug',
        'sku',
        'part_number',
        'vin_code',
        'fav_product',
        'original_price',
        'sale_price',
        'stock_type',
        'stock_quantity',
        'feature_image',
        'gallery_images',
        'description',
        'short_description',
        'meta_title',
        'meta_description'
    ];

    protected $casts = [
        'gallery_images' => 'array', // JSON to array automatically
        'sale_price'     => 'decimal:2',
        'discount_price' => 'decimal:2',
        'fav_product' => 'boolean',
    ];

    public function carBrand(){
        return $this->belongsTo(CarBrand::class, 'car_brand_id');
    }

    public function carModel(){
        return $this->belongsTo(CarModel::class, 'car_model_id');
    }

    public function carPartType(){
        return $this->belongsTo(CarPartType::class, 'part_type_id');
    }

    public function carPartBrand(){
        return $this->belongsTo(CarPartBrand::class, 'part_brand_id');
    }

   public static function generateSlug($title, $ignoreId = null)
    {
        $originalSlug = Str::slug($title);

        // grab all slugs that start with the base (including base itself)
        $query = DB::table('car_parts')->select('slug')->where('slug', 'like', $originalSlug . '%');
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }
        $slugs = $query->pluck('slug')->toArray();

        // if the base slug isn't used, return it
        if (!in_array($originalSlug, $slugs)) {
            return $originalSlug;
        }

        // find the maximum numeric suffix used, then return max+1
        $max = 1;
        foreach ($slugs as $s) {
            if ($s === $originalSlug) {
                $max = max($max, 1);
                continue;
            }
            if (preg_match('/^' . preg_quote($originalSlug, '/') . '-(\d+)$/', $s, $m)) {
                $num = intval($m[1]);
                if ($num > $max) $max = $num;
            }
        }

        return $originalSlug . '-' . ($max + 1);
    }
}
