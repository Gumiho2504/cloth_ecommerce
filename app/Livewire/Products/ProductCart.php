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

        return $this->redirectRoute('product.show', $this->product->slug, true);
    }
    public function render()
    {
        return view('livewire.products.product-cart');
    }
}
