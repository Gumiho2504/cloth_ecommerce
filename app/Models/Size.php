<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    /** @use HasFactory<\Database\Factories\SizeFactory> */
    use HasFactory;

    protected $fillable = [
        'type'
    ];


    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_sizes');
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }
}
