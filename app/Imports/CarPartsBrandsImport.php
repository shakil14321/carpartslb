<?php

namespace App\Imports;

use App\Models\CarPartBrand;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CarPartsBrandsImport implements ToModel, WithHeadingRow
{
    /**
     * Import logic:
     * - If slug exists, update row (update-if-exists mode)
     * - Otherwise, insert new row
     */
    public function model(array $row)
    {
        if (!isset($row['slug']) || !isset($row['title'])) {
            return null; // skip rows without required fields
        }

        // try to find existing by slug
        $brand = CarPartBrand::where('slug', $row['slug'])->first();

        if ($brand) {
            $brand->update([
                'title' => $row['title'],
                'description' => $row['description'] ?? null,
                'brand_image' => $row['brand_image'] ?? $brand->brand_image,
            ]);
            return null; // don't insert new record
        }

        // insert new
        return new CarPartBrand([
            'title'       => $row['title'],
            'slug'        => $row['slug'] ?: Str::slug($row['title']),
            'description' => $row['description'] ?? null,
            'brand_image' => $row['brand_image'] ?? null,
        ]);
    }
}
