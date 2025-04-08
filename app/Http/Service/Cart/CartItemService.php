<?php

namespace App\Http\Service\Cart;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CartItemService implements ICartItemService
{
    public static function addItemToCart($cart_id, $product_id, $color_id, $size_id, $uni_price, $quantity)
    {


        //find carts
        $cart = Cart::findOrFail($cart_id);
        Gate::authorize('create', Cart::findOrFail($cart_id));



        // get product
        $product = \App\Models\Product::findOrFail($product_id);

        //check product is exist
        $cartItem = $cart->cartItems()->where('product_id', $product_id)
            ->where('color_id', $color_id)
            ->where('size_id', $size_id)
            ->first();

        if (!$cartItem) {
            $cartItem = $cart->cartItems()->create([
                'product_id' => $product_id,
                'quantity' => $quantity,
                'color_id' => $color_id,
                'size_id' => $size_id,
                'total_price' => $product->price * $quantity,
                'uni_price' => $product->price
            ]);
        } else {
            $cart->update([

                'total_amount' => $cart->cartItems()->sum('total_price')
            ]);
            $cartItem->update([
                'quantity' => $quantity,
                'total_price' => $cartItem->total_price + ($product->price * $quantity)
            ]);
        }

        $cart->update([
            'total_amount' => $cart->cartItems()->sum('total_price')
        ]);
    }

    public static function deleteCartItems($item_id, $cart_id)
    {

        $item = CartItem::findOrFail($item_id);
        $cart = Cart::findOrFail($cart_id);
        $cart = $item->cart;
        $cart->update([
            'total_amount' => $cart->cartItems()->sum('total_price')
        ]);
        $item->delete();
        $cart->update([
            'total_amount' => $cart->cartItems()->sum('total_price')
        ]);
    }

    public static function updateQuantity($quantity, $item_id, $cart_id)
    {

        $cart = Cart::findOrFail($cart_id);
        $item = CartItem::findOrFail($item_id);
        $item->update([
            'quantity' => $quantity,
            'total_price' => $quantity * $item->uni_price
        ]);
        $cart->update([
            'total_amount' => $cart->cartItems()->sum('total_price')
        ]);
        return $item;
    }
}
