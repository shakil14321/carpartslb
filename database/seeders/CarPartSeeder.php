<?php

namespace Database\Seeders;

use Carbon\Factory;
use App\Models\CarPart;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\CarPartType;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CarPartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $brands = CarBrand::all();
    $models = CarModel::all();
    $partTypes = CarPartType::all();

    $faker = \Faker\Factory::create();

    if ($brands->count() === 0 || $models->count() === 0 || $partTypes->count() === 0) {
        $this->command->info('Please seed brands, models, and part types first!');
        return;
    }

    for ($i = 0; $i < 100; $i++) {
        $brand = $brands->random();
        $model = $models->where('car_brand_id', $brand->id)->random(); // Model from same brand
        $partType = $partTypes->random();

        $name = $faker->word . ' ' . $partType->title . ' ' . $model->title;
        $sku = strtoupper(Str::random(3)) . '-' . strtoupper(Str::random(3)) . '-' . rand(100, 999);
        $partNumber = strtoupper(Str::random(8));

        CarPart::create([
            'car_brand_id' => $brand->id,
            'car_model_id' => $model->id,
            'part_type_id' => $partType->id,
            'title' => $name,
            'slug' => Str::slug($name . '-'),
            'sku' => $sku,
            'part_number' => $partNumber,
            'sale_price' => $faker->randomFloat(2, 50, 500),
            'discount_price' => $faker->randomFloat(2, 20, 49), // Now this column exists
            'description' => $faker->paragraph,
        ]);
    }
}

}
