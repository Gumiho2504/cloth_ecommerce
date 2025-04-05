<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    /** @use HasFactory<\Database\Factories\CartItemFactory> */
    use HasFactory;

    protected $fillable = [
        'cart_id','product_id','total_price','uni_price','quantity'
    ];

    public function cart() {
        return $this->belongsTo(Cart::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
