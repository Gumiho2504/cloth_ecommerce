<?php

namespace Database\Seeders;

use App\Livewire\Pages\Category;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Psy\debug;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            CategorySeeder::class,
            ColorSeeder::class,
            SizeSeeder::class,
            ProductSeeder::class,

        ]);

        if (CategorySeeder::$called) {
            echo "Database Seeded";
        }
    }
}
