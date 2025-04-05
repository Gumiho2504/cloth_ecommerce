<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Man Fashion','Wonman Fashion','Shoes & Bag','Accessories'];
       foreach($categories as $category){
        Category::factory()->sequence(
            [
                'name' => $category
            ]
        )->create();
       }
    }
}
