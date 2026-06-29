<?php

namespace Database\Seeders;

use App\Models\brand;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
class brandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = ['Toyota', 'Honda', 'Ford', 'Suzuki', 'Hyundai'];

        $fake = Faker::create();

        foreach ($brands as $brand) {
            brand::create([
                'title' => $brand,
                'slug' => Str::slug($brand . '-'),
                'description' => "This is description is for this brand: $brand",
            ]);
        }
    }
}
