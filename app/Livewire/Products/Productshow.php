<?php

namespace App\Livewire\Products;

use App\Http\Service\Cart\CartItemService;
use App\Http\Service\Cart\CartService;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\layout;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Url;

#[layout('layouts.app')]
class Productshow extends Component
{


    public $product;
    #[Url()]
    public int $color_id;
    #[Url()]
    public int $size_id;
    public $stockByColor;
    public $quantity = 1;

    public function placeholder()
    {
        return <<<'HTML'
        <div>
            <!-- Loading spinner... -->
            <h1>Loding--</h1>
        </div>
        HTML;
    }

    public function mount($slug)
    {
        $this->product = Product::where('slug', $slug)->first();
        $this->color_id = $this->product->colors()->first()->id;
        $this->size_id = $this->product->sizes()->first()->id;
        // dump([$this->color_id, $this->size_id]);

    }


    public function render()
    {

        $variation = $this->product->variations()->where('color_id', $this->color_id)->where('size_id', $this->size_id)->first();
        $this->stockByColor = $variation->stock;
        return view('livewire.products.productshow')->with('product', $this->product);
    }

    public function selectSize(int $id)
    {
        $this->size_id = $id;
    }

    public function selectColor(int $id)
    {

        $this->color_id = $id;
    }

    public function onChangeQuantity($isAdd)
    {
        if ($isAdd) {
            if ($this->quantity < $this->stockByColor) {
                $this->quantity += 1;
            }
        } else {
            if ($this->quantity > 1) {
                $this->quantity -= 1;
            }
        }
    }



    public function addToCart()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->carts()->exists()) {

            CartItemService::addItemToCart(
                auth()->user()->carts()->first()->id,
                $this->product->id,
                $this->color_id,
                $this->size_id,
                $this->product->price,
                $this->quantity
            );
        } else {

            $cart = CartService::creatCart(auth()->user()->id);
            CartItemService::addItemToCart(
                $cart->id,
                $this->product->id,
                $this->color_id,
                $this->size_id,
                $this->product->price,
                $this->quantity
            );
        }
        $this->redirectRoute('carts', navigate: true);
    }
}
