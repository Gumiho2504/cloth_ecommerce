<?php

namespace Database\Seeders;

use App\Enums\SizeType;
use App\Models\Size;
use Database\Factories\SizeFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (SizeType::cases() as $type) {
            Size::factory()->sequence(
                [
                    'type' => $type
                ]
            )->create();
        }
    }
}
