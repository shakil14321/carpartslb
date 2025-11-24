<?php

namespace App\Imports;

use App\Models\CarPartType;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CarPartTypesImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        // Update-if-exists (slug basis) else create new
        $carPartType = CarPartType::where('slug', $row['slug'])->first();

        if ($carPartType) {
            $carPartType->update([
                'title'           => $row['title'],
                'description'     => $row['description'] ?? null,
                'part_type_image' => $row['part_type_image'] ?? null,
            ]);
            return $carPartType;
        }

        return new CarPartType([
            'title'           => $row['title'],
            'slug'            => $row['slug'],
            'description'     => $row['description'] ?? null,
            'part_type_image' => $row['part_type_image'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            '*.title' => ['required', 'string'],
            '*.slug'  => ['required', 'string'],
        ];
    }
}
