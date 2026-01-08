<?php

namespace Database\Seeders;

use App\Models\CartonType;
use Illuminate\Database\Seeder;

class CartonTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default carton types
        CartonType::firstOrCreate(
            ['name' => 'Type A'],
            [
                'capacity' => 125000,
                'description' => 'Carton standard - 125,000 capsules',
                'is_active' => true
            ]
        );

        CartonType::firstOrCreate(
            ['name' => 'Type B'],
            [
                'capacity' => 120000,
                'description' => 'Carton optimisé - 120,000 capsules',
                'is_active' => true
            ]
        );
    }
}
