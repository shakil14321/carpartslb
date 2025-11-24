<?php

namespace App\Imports;

use App\Models\CarModel;
use App\Models\CarBrand;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CarModelsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // brand name se brand ka record nikalo
        $brand = CarBrand::where('title', $row['car_brand_name'])->first();

        return new CarModel([
            'car_brand_id' => $brand ? $brand->id : null, // agar brand mila
            'title'        => $row['title'],
            'slug'         => $row['slug'],
            'year'         => $row['year'],
            'description'  => $row['description'],
            'model_image'  => $row['model_image'],
            'created_at'   => $row['created_at'] ?? now(),
            'updated_at'   => $row['updated_at'] ?? now(),
        ]);
    }
}
