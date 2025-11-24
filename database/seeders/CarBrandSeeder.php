<?php

namespace Database\Seeders;

use App\Models\CarBrand;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
class CarBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = ['Toyota', 'Honda', 'Ford', 'Suzuki', 'Hyundai'];

        $fake = Faker::create();

        foreach ($brands as $brand) {
            CarBrand::create([
                'title' => $brand,
                'slug' => Str::slug($brand . '-'),
                'description' => "This is description is for this brand: $brand",
            ]);
        }
    }
}
