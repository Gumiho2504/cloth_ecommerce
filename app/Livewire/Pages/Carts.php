<?php

namespace App\Livewire\Pages;

use App\Http\Service\Cart\CartItemService;
use App\Http\Service\Cart\CartService;
use App\Http\Service\Order\OrderService;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

#[Layout('layouts.app')]
class Carts extends Component
{
    public $carts;
    public $cart;
    #[On('update_total_amount')]
    public function render()
    {
        $this->carts = Auth::user()->carts()->get();
        $cart = Auth::user()->carts()->first();
        $this->cart = $cart;
        return view('livewire.pages.carts', compact('cart'));
    }


    public function deleteCardItem($id)
    {
        CartItemService::deleteCartItems($id);
        auth()->user()->carts()->first()->update(['total_amount' => auth()->user()->carts()->first()->cartItems()->sum('total_price')]);
    }

    public function deleteCart($cartId)
    {
        $user = Auth::user();
        CartService::deleteCart($user, $cartId);
    }


    public function updateCartItemQuatity(CartItem $item, $request)
    {
        $validattData = $request->validation([
            'quatity' => 'require|max:1'
        ]);
        $item->update([
            'qautity' => $request['']
        ]);
    }

    public function placeOrder()
    {
        //if($carts->cart)

        foreach ($this->cart->cartItems as $item) {
            $stock =  ProductVariation::where('color_id', $item->color_id)
                ->where('size_id', $item->size_id)
                ->where('product_id', $item->product_id)->first()->stock;
            if ($item->quantity > $stock) {
                session()->flash('error', $item->product->name . ' is not have engoues stock.please remove !');
                return redirect()->back();
            }
        }



        $order = OrderService::placeOrder(Auth::id());
        if ($order == null) {
            session()->flash('error', 'Your cart is empty');
            return redirect()->back();
        }

        session()->flash('success', 'order successfully!');
        return redirect(route('order-list'));
    }
}
