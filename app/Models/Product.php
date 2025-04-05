<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_colors');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes');
    }

    public function image()
    {
        return $this->hasManyThrough(Color::class, Image::class);
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }



    public function scopeFilter(Builder | QueryBuilder $query, array $filters): Builder | QueryBuilder
    {
        $minPrice = $filters['minPrice'] ?? null;
        $maxPrice = $filters['maxPrice'] ?? null;

        return $query
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            })
            ->when($filters['category'] ?? null, function ($query, $category) {
                $query->whereHas('category', function ($query) use ($category) {
                    $query->where('slug', $category);  // Removed 'like' if exact match is intended
                });
            })
            ->when($filters['color'] ?? null, function ($query, $color) {
                $query->whereHas('colors', function ($query) use ($color) {
                    $query->where('name', $color);  // Removed 'like' if exact match is intended
                });
            })
            ->when($filters['size'] ?? null, function ($query, $size) {
                $query->whereHas('sizes', function ($query) use ($size) {
                    $query->where('type', $size);  // Removed 'like' if exact match is intended
                });
            })
            ->when($minPrice && !$maxPrice, function ($query) use ($minPrice) {
                $query->where('price', '>=', $minPrice)->orderBy('price', 'asc');  // Fixed comparison operator
            })
            ->when($maxPrice && !$minPrice, function ($query) use ($maxPrice) {
                $query->where('price', '<=', $maxPrice)->orderBy('price', 'asc');  // Fixed comparison operator
            })
            ->when($minPrice && $maxPrice, function ($query) use ($minPrice, $maxPrice) {
                $query->whereBetween('price', [$minPrice, $maxPrice])->orderBy('price', 'asc');
            });
    }

    public function scopePrice(Builder | QueryBuilder $query, string $order): Builder | QueryBuilder
    {
        return $query->orderBy('price', $order);
    }


    // public function scopeStockByColorAndSize($color_id, $size_id): int
    // {
    //     return $this->whereHas('variations', function ($query) use ($color_id, $size_id) {
    //         $query->where('color_id', $color_id)->where('size_id', $size_id);
    //     })->get()->stock;
    // }


    public static function booted()
    {
        static::saving(function ($product) {
            $originalSlug = Str::slug($product->name);
            $slug = $originalSlug;
            $count = 1;

            // Check if slug exists and append number if needed
            while (Product::where('slug', $slug)->where('id', '!=', $product->id ?? 0)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }

            $product->slug = $slug;
        });
    }
}
