<?php

namespace App\Livewire\Components;

use App\Http\Service\Cart\CartItemService;
use App\Models\Image;
use App\Models\ProductVariation;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Rule;
use Livewire\Component;



class CartItem extends Component
{
    public  $item;
    #[Rule('min:0|max:10')]
    public $quantity;
    public $cart;
    public $image_path;
    public int $stock;

    public function mount($cartItem, $cart)
    {
        $this->item = $cartItem;
        $this->quantity = $this->item->quantity;
        $this->cart = $cart;
        $this->image_path = Image::where('product_id', $this->item->product_id)->where('color_id', $this->item->color_id)
            ->first()->path;
        $this->stock = ProductVariation::where('color_id', $this->item->color_id)
            ->where('size_id', $this->item->size_id)
            ->where('product_id', $this->item->product_id)->first()->stock;
        $this->isInStock();
        dump($this->isInStock());
    }


    public function isInStock(): bool
    {
        return $this->quantity <= $this->stock;
    }

    public function render()
    {
        return view('livewire.components.cart-item');
    }

    public function deleteItem()
    {
        CartItemService::deleteCartItems($this->item->id, $this->cart->id);
        $this->dispatch("update_total_amount");
    }

    public function updateQuantity(bool $isAdd)
    {


        if ($isAdd) {
            $this->quantity += 1;
        } elseif ($this->quantity > 1) {
            $this->quantity -= 1;
        }


        $this->isInStock();
        $this->item = CartItemService::updateQuantity($this->quantity, $this->item->id, $this->cart->id);
        //dd($cartItem);
        $this->dispatch("update_total_amount", isInStock: $this->isInStock());
    }
}
