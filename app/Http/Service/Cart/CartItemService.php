<?php

namespace App\Http\Service\Cart;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Gate;

class CartItemService implements ICartItemService
{
    public static function addItemToCart($cart_id, $product_id, $uni_price, $quantity)
    {


        Gate::authorize('create', Cart::findOrFail($cart_id));
        //find cart
        $cart = Cart::findOrFail($cart_id);

        // get product
        $product = \App\Models\Product::findOrFail($product_id);

        //check product is exist
        $cartItem = $cart->cartItems()->where('product_id', $product_id)->first();
        if ($cartItem == null) {
            $cartItem = $cart->cartItems()->create([
                'product_id' => $product_id,
                'quantity' => $quantity,
                'total_price' => $product->price * $quantity,
                'uni_price' => $product->price
            ]);
        } else {
            $cartItem->update([
                'quantity' => $cartItem->quantity + $quantity,

            ]);
            $cartItem->update([
                'total_price' => $cartItem->total_price + ($product->price * $quantity)
            ]);
        }

        $cart->update([
            'total_amount' => $cart->cartItems()->sum('total_price')
        ]);
    }

    public static function deleteCartItems($item_id)
    {

        $item = CartItem::findOrFail($item_id);
        $cart = $item->cart;
        $cart->update([
            'total_amount' => $cart->cartItems()->sum('total_price')
        ]);
        $item->delete();
    }
}
