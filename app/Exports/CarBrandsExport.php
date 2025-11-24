<?php

namespace App\Exports;

use App\Models\CarBrand;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CarBrandsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return CarBrand::select('id', 'title', 'slug', 'description', 'brand_image', 'created_at', 'updated_at')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Title', 'Slug', 'Description', 'Brand Image', 'Created At', 'Updated At'];
    }
}
