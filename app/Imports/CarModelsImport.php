<?php

namespace App\Imports;

use App\Models\CarModel;
use App\Models\brand;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CarModelsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
       // brand name se brand ka record nikalo
        $brand = brand::where('title', $row['car_brand_name'])->first();

        $slug = Str::slug($row['slug']);
        $originalSlug = $slug;
        $counter = 2;

        // ❗ Step 2: create unique slug (prevent duplicate key error)
        while (CarModel::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return new CarModel([
            'car_brand_id' => $brand ? $brand->id : null, // agar brand mila
            'title'        => $row['title'],
            'slug'         => $slug,
            'year'         => $row['year'],
            'description'  => $row['description'],
            'model_image'  => $row['model_image'],
            'created_at'   => $row['created_at'] ?? now(),
            'updated_at'   => $row['updated_at'] ?? now(),
        ]);
    }
}
