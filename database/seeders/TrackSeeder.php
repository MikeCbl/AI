<?php

namespace Database\Seeders;

use Barryvdh\Reflection\DocBlock\Description;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tracks')->insert([
            [
                'id' => 1,
                'name' => '25m Indoor Range',
                'description' => 'Multi-lane indoor shooting range.',
                'price_per_hour' => 40.00,
                'img' => 'img/track/default/25m_indoor.jpg',
                'is_available' => true,
            ],
            [
                'id' => 2,
                'name' => '50m Outdoor Range',
                'description' => 'Multi-lane indoor shooting range.',
                'price_per_hour' => 50.00,
                'img' => 'img/track/default/50m_outdoor.jpg',
                'is_available' => false,
            ],
            [
                'id' => 3,
                'name' => '100m Outdoor Range',
                'description' => 'Single-lane outdoor range.',
                'price_per_hour' => 75.00,
                'img' => 'img/track/default/100m.jpg',
                'is_available' => true,
            ],
            [
                'id' => 4,
                'name' => '300m Outdoor Range',
                'description' => 'Three-lane outdoor range.',
                'price_per_hour' => 100.00,
                'img' => 'img/track/default/300m.jpg',
                'is_available' => true,
            ],
        ]);
    }
}
