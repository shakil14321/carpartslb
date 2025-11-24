<?php

namespace Database\Seeders;

use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\CarModelBrand;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CarModelBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $toyota = CarBrand::where('name', 'Toyota')->first();
        $corolla = CarModel::where('name', 'Corolla')->first();

        if ($toyota && $corolla) {
            CarModelBrand::create([
                'car_model_id' => $corolla->id,
                'car_brand_id' => $toyota->id,
            ]);
        }
    }
}
