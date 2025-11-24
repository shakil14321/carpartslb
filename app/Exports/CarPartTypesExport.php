<?php

namespace App\Exports;

use App\Models\CarPartType;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CarPartTypesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return CarPartType::select('id', 'title', 'slug', 'description', 'part_type_image', 'created_at', 'updated_at')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Title', 'Slug', 'Description', 'Part Type Image', 'Created At', 'Updated At'];
    }
}
