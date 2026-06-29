<?php

namespace App\Exports;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class brandsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Brand::select('id', 'title', 'slug', 'description', 'brand_image', 'created_at', 'updated_at')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Title', 'Slug', 'Description', 'Brand Image', 'Created At', 'Updated At'];
    }
}
