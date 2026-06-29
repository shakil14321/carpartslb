<?php

namespace App\Imports;

use App\Models\product;
use App\Models\brand;
use App\Models\CarModel;
use App\Models\CarPartType;
use App\Models\SubCategories;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class CarPartsImport implements ToModel, WithHeadingRow, WithValidation, WithChunkReading
{
    use Importable, SkipsFailures;

    public function model(array $row)
    {

        if (product::where('sku', $row['sku'])->exists()) {
            return null; // Skip this row instead of inserting
        }
        // Map names to IDs
        $brandId  = brand::where('title', $row['car_brand_name'])->value('id');
        $carModelId  = CarModel::where('title', $row['car_model_name'])->value('id');
        $partTypeId  = CarPartType::where('title', $row['part_type_name'])->value('id');
        $partBrandId = SubCategories::where('title', $row['part_brand_name'])->value('id');

        // ✅ Handle gallery images
        $galleryImages = [];
        if (!empty($row['gallery_images'])) {
            if (strpos($row['gallery_images'], '|') !== false) {
                $galleryImages = explode('|', $row['gallery_images']);
            } elseif (strpos($row['gallery_images'], ',') !== false) {
                $galleryImages = explode(',', $row['gallery_images']);
            } elseif (strpos($row['gallery_images'], '[') !== false) {
                $decoded = json_decode($row['gallery_images'], true);
                $galleryImages = is_array($decoded) ? $decoded : [];
            }
            $galleryImages = array_map('trim', $galleryImages);
        }

        // ✅ Slug normalize & unique
        $slug = Str::slug($row['slug']);
        $originalSlug = $slug;
        $counter = 2;
        while (product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return new product([
            'car_brand_id'       => $brandId,
            'car_model_id'       => $carModelId,
            'part_type_id'       => $partTypeId,
            'part_brand_id'      => $partBrandId,
            'title'              => $row['title'],
            'slug'               => $slug,
            'sku'                => $row['sku'],
            'part_number'        => $row['part_number'],
            'vin_code'           => $row['vin_code'],
            'fav_product'        => $row['fav_product'] ?? 0,
            'original_price'     => $row['original_price'],
            'sale_price'         => $row['sale_price'],
            'stock_type'         => $row['stock_type'] ?? 'in',
            'stock_quantity'     => $row['stock_quantity'] ?? 0,
            // ✅ Feature image normal string (trim safe)
            'feature_image'      => !empty($row['feature_image']) ? trim($row['feature_image']) : null,
            // ✅ Gallery images JSON encode
            'gallery_images'     => !empty($galleryImages) ? json_encode($galleryImages) : json_encode([]),
            'description'        => $row['description'],
            'short_description'  => $row['short_description'],
            'meta_title'         => $row['meta_title'],
            'meta_description'   => $row['meta_description']
        ]);
    }

    public function rules(): array
    {
        return [
            '*.title'        => ['required', 'string', 'max:255'],
            '*.slug'         => ['required', 'string', 'max:255'],
            '*.sku'          => ['required', 'string', 'max:255'],
            '*.part_number'  => ['required'],
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
