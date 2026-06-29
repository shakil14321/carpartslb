<?php

namespace App\Models;

use App\Models\products;
use App\Models\CarModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    Use HasFactory;
    protected $table = 'brands';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'brand_image'
    ];

    public function carPart(){
       return $this->hasMany(products::class, 'car_brand_id');
    }

    public function carModel(){
        return $this->hasMany(CarModel::class, 'car_brand_id');
    }

      public static function generateSlug($title, $ignoreId = null)
    {
        $originalSlug = Str::slug($title);

        // grab all slugs that start with the base (including base itself)
        $query = DB::table('brands')->select('slug')->where('slug', 'like', $originalSlug . '%');
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
