<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
            'name' => $this->faker->name,
            'category_id' => Category::all()->random()->id,
            'description' => $this->faker->paragraph(200),
            'price' => $this->faker->numberBetween(10, 100),
            'image' => $imageUrl[array_rand($imageUrl)],
        ];
    }
}
