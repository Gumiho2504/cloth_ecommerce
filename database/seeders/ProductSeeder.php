<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::factory(20)->create();

        $colors = \App\Models\Color::all();
        foreach ($products as $product) {
            $sizes = \App\Models\Size::all();
            $product->sizes()->attach($sizes->pluck('id'));
            $product_colors = rand(1, 4);
            $selecteColors = $colors->random($product_colors);
            $product->colors()->attach($selecteColors->pluck('id'));

            foreach ($selecteColors as $color) {
                foreach ($sizes as $size) {
                    ProductVariation::factory()->sequence(
                        [
                            'product_id' => $product->id,
                            'color_id' => $color->id,
                            'size_id' => $size->id
                        ]
                    )->create();
                }
                Image::factory()->sequence(
                    [
                        'product_id' => $product->id,
                        'color_id' => $color->id,

                    ]
                )->create();
            }
        }
    }
}
