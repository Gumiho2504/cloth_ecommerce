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
        //dump("filters", $filters);
        return $query
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->where(fn($query) => $query->where('name', 'like', '%' . $search . '%'));
            })
            ->when($filters['category'] ?? null, function ($query, $category) {
                $query->whereHas('category', fn($query) => $query->where('slug', 'like', $category));
            })
            ->when($filters['color'] ?? null, function ($query, $color) {
                $query->whereHas('colors', fn($query) => $query->where('name', 'like', $color));
            })
            ->when($filters['size'] ?? null, function ($query, $size) {
                $query->whereHas('sizes', fn($query) => $query->where('type', 'like', $size));
            })
            ->when($filters['price']  ?? null, function ($query, $price) {
                $query->where('price', '>=', $price);
            })
        ;
    }


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
