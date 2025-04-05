<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            'Red',
            'Green',
            'Blue',
            'Yellow',
            'Black',
            'White',
            'Gray',
            'Orange',
            'Purple',
            'Pink'
        ];

        foreach ($colors as $color) {
            \App\Models\Color::factory()->sequence(
                [
                    'name' => $color
                ]
            )->create();
        }
    }
}
