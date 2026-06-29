<?php

namespace App\Exports;

use App\Models\products;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CarPartsExport implements FromQuery, WithMapping, WithHeadings
{
    public function query()
    {
        // You can filter data if needed
        return products::query()->with(['brand', 'carModel', 'carPartType']);
    }

    public function map($carPart): array
    {
         return [
            $carPart->id,
            optional($carPart->brand)->title,
            optional($carPart->carModel)->title,
            optional($carPart->carPartType)->title,
            optional($carPart->SubCategories)->title,
            $carPart->title,
            $carPart->slug,
            $carPart->sku,
            $carPart->part_number,
            $carPart->vin_code,
            $carPart->fav_product,
            $carPart->original_price,
            $carPart->sale_price,
            $carPart->stock_type,
            $carPart->stock_quantity,
            $carPart->feature_image,
            implode('|', is_array($carPart->gallery_images) ? $carPart->gallery_images : json_decode($carPart->gallery_images ?? '[]', true)),
            $carPart->description,
            $carPart->short_description,
            $carPart->meta_title,
            $carPart->meta_description
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Car Brand Name',
            'Car Model Name',
            'Part Type Name',
            'Sub Categories Name',
            'Title',
            'Slug',
            'SKU',
            'Part Number',
            'VIN Code',
            'Fav Product',
            'Original Price',
            'Sale Price',
            'Stock Type',
            'Stock Quantity',
            'Feature Image',
            'Gallery Images',
            'Description',
            'Short Description',
            'meta_title',
            'meta_description'
        ];
    }
}
