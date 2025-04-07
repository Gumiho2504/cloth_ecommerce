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
    public static function getCart($user_id) {}


    public static function deleteCart(User $user, $cart_id)
    {
        Gate::authorize('delete', Cart::findOrFail($cart_id));
        Cart::findOrFail($cart_id)->delete();
    }
}
