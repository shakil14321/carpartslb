<?php

namespace Database\Seeders;

use App\Models\CarModel;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CarModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carModels = [
            [
                'car_brand_id' => 21,
                'title' => 'Civic',
                'year' => 2020,
                'description' => 'Popular compact car from Honda.',
            ],
            [
                'car_brand_id' => 22,
                'title' => 'Accord',
                'year' => 2021,
                'description' => 'Mid-size sedan with luxury feel.',
            ],
            [
                'car_brand_id' => 23,
                'title' => 'Corolla',
                'year' => 2019,
                'description' => 'Reliable car from Toyota.',
            ],
            [
                'car_brand_id' => 24,
                'title' => 'Camry',
                'year' => 2022,
                'description' => 'Comfortable and stylish sedan.',
            ],
            [
                'car_brand_id' => 25,
                'title' => 'Model S',
                'year' => 2023,
                'description' => 'Electric sedan from Tesla.',
            ],
        ];

        foreach ($carModels as $model) {
            CarModel::create([
                'car_brand_id' => $model['car_brand_id'],
                'title' => $model['title'],
                'slug' => Str::slug($model['title'] . '-'),
                'year' => $model['year'],
                'description' => $model['description'],
            ]);
        }
    }
}
