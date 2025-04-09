<?php

namespace App\Http\Service\Cart;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CartService implements ICartService
{
    public static function creatCart($user_id): Cart
    {
        Gate::authorize('create', Cart::class);
        return Cart::create([
            'user_id' => $user_id,
            'total_amount' => 0,

        ]);
    }
    public static function getCart($user_id)
    {
        $cart =  Cart::where('user_id', $user_id)->first();
        return $cart;
    }


    public static function deleteCart($user_id, $cart_id)
    {

        $cart = Cart::where('user_id', $user_id)->where('id', $cart_id)->first();
        Gate::authorize('delete', $cart);
        $cart->delete();
    }
}
