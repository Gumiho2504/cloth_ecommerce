<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    /** @use HasFactory<\Database\Factories\ColorFactory> */
    use HasFactory;


    protected $fillable = ['name'];

    public function css(): string
    {

        return match ($this->name) {
            'Red' => 'bg-red-500',
            'Green' => 'bg-green-500',
            'Blue' => 'bg-blue-500',
            'Yellow' => 'bg-yellow-500',
            'Black' => 'bg-black',
            'White' => 'bg-white',
            'Gray' => 'bg-gray-500',
            'Orange' => 'bg-orange-500',
            'Purple' => 'bg-purple-500',
            'Pink' => 'bg-pink-500',
            default => 'bg-gray-300', // fallback if name doesn't match
        };
    }

    public function borderColor(): string
    {

        return match ($this->name) {
            'Red' => 'border-red-500',
            'Green' => 'border-green-500',
            'Blue' => 'border-blue-500',
            'Yellow' => 'border-yellow-500',
            'Black' => 'border-black',
            'White' => 'border-white',
            'Gray' => 'border-gray-500',
            'Orange' => 'border-orange-500',
            'Purple' => 'border-purple-500',
            'Pink' => 'border-pink-500',
            default => 'border-gray-300', // fallback if name doesn't match
        };
    }


    public function productColors()
    {
        return $this->hasMany(ProductColor::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_colors', 'color_id', 'product_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }
}
