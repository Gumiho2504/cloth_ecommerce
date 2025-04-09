<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $imageUrl = [
            'https://pagedone.io/asset/uploads/1701167607.png',
            'https://pagedone.io/asset/uploads/1701167652.png',
            'https://pagedone.io/asset/uploads/1701167668.png',
            'https://pagedone.io/asset/uploads/1701167681.png',
            'https://pagedone.io/asset/uploads/1701167697.png',
            'https://pagedone.io/block_preview_image/Order-Summaries-4.jpg',
            'https://pagedone.io/block_preview_image/Order-Summaries-4.jpg',
            'https://pagedone.io/block_preview_image/Order-Summaries-4.jpg',
            'https://pagedone.io/block_preview_image/Order-Summaries-5.jpg',
            'https://pagedone.io/block_preview_image/Order-Summaries-5.jpg',
            'https://pagedone.io/block_preview_image/order-summaries-main7.jpg',
            'https://pagedone.io/block_preview_image/order-summaries-main8.jpg'
        ];

        return [
            'product_id' => \App\Models\Product::first()->id,
            'color_id' => \App\Models\Color::first()->id,
            'path' => $imageUrl[array_rand($imageUrl)],

        ];
    }
}
