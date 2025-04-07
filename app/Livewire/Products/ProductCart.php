<?php

namespace App\Livewire\Products;

use App\Http\Service\Cart\CartItemService;
use App\Http\Service\Cart\CartService;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductCart extends Component
{
    public $product;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function addToCart()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->carts()->exists()) {

            CartItemService::addItemToCart(auth()->user()->carts()->first()->id, $this->product->id, $this->product->price, 1);
        } else {

            $cart = CartService::creatCart(auth()->user()->id);
            CartItemService::addItemToCart($cart->id, $this->product->id, $this->product->price, 1);
        }

        return redirect()->route('profile');
    }
    public function render()
    {
        return view('livewire.products.product-cart');
    }
}
