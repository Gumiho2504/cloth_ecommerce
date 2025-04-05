<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }


    public static function booted()
    {
        static::saving(function ($category) {
            $originalSlug = Str::slug($category->name);
            $slug = $originalSlug;
            $count = 1;

            // Check if slug exists and append number if needed
            while (Category::where('slug', $slug)->where('id', '!=', $category->id ?? 0)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }

            $category->slug = $slug;
        });
    }
}
