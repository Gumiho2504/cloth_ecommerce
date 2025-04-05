<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\layout;
use Livewire\Attributes\Url;
use App\Models\Product;

#[layout('layouts.app')]
class Home extends Component
{

    public $size;

    public $search;

    #[Url()]
    public $filters;

    public $category;

    public $maxPrice;
    public $minPrice;
    public $color;

    public $results = [];
    public $products = [];


    public function render()
    {


        $this->filters = [
            "search" => $this->search,
            "size" => $this->size,
            "category" => $this->category,
            'minPrice' => $this->minPrice,
            'maxPrice' => $this->maxPrice,
            'color' => $this->color
        ];
        if (strlen($this->search) >= 2) {
            $this->results = \App\Models\Product::where('name', 'like', '%' . $this->search . '%')->get();
        }

        $this->products = \App\Models\Product::filter($this->filters)->latest()->get();

        return view(
            'livewire.pages.home'
        );
    }


    public function addToCart(Product $product)
    {

        if (auth()->user()->carts()->exists()) {
            if (auth()->user()->carts()->first()->cartItems()->where('product_id', $product->id)->exists()) {
                $cartItem = auth()->user()->carts()->first()->cartItems()->where('product_id', $product->id)->first();
                $cartItem->update(['quantity' => $cartItem->quantity + 1]);
                $cartItem->update(['total_price' => $cartItem->quantity * $cartItem->uni_price]);
                auth()->user()->carts()->first()->update(['total_amount' => auth()->user()->carts()->first()->cartItems()->sum('total_price')]);
            } else {
                auth()->user()->carts()->first()->cartItems()->create(
                    [
                        'product_id' => $product->id,
                        'quantity' => 1,
                        'total_price' => $product->price * 1,
                        'uni_price' => $product->price,
                    ]

                );
            }

            auth()->user()->carts()->first()->update(['total_amount' => auth()->user()->carts()->first()->cartItems()->sum('total_price')]);
            return redirect()->route('profile');
        } else {
            auth()->user()->carts()->create(
                [
                    'total_amount' => 0,
                ]
            );
        }
    }
}
