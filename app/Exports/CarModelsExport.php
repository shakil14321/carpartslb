<?php
namespace App\Exports;

use App\Models\CarModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CarModelsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return CarModel::join('car_brands', 'car_models.car_brand_id', '=', 'car_brands.id')
            ->select(
                'car_models.id',
                'car_brands.title as car_brand_name', // brand ka naam
                'car_models.title',
                'car_models.slug',
                'car_models.year',
                'car_models.description',
                'car_models.model_image',
                'car_models.created_at',
                'car_models.updated_at'
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Car Brand Name', // yahan bhi change
            'Title',
            'Slug',
            'Year',
            'Description',
            'Model Image',
            'Created At',
            'Updated At',
        ];
    }
}
