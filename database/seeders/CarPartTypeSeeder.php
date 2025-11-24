<?php

namespace Database\Seeders;

use App\Models\CarPartType;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CarPartTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Engine',
            'Brakes',
            'Suspension',
            'Transmission',
            'Exhaust',
            'Electrical',
            'Cooling System',
            'Fuel System',
            'Steering',
            'Body Parts',
        ];

        foreach ($types as $type) {
            CarPartType::create([
                'title' => $type,
                'slug' => Str::slug($type. '-'),
                'description' => "$type parts for various vehicles.",
            ]);
        }
    }
}
