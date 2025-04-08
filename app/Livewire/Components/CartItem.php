<?php

namespace App\Livewire\Components;

use App\Http\Service\Cart\CartItemService;
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

    public function mount($cartItem, $cart)
    {
        $this->item = $cartItem;
        $this->quantity = $this->item->quantity;
        $this->cart = $cart;
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

        $this->item = CartItemService::updateQuantity($this->quantity, $this->item->id, $this->cart->id);
        //dd($cartItem);
        $this->dispatch("update_total_amount");
    }
}
