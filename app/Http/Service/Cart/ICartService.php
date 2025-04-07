<?php


namespace App\Http\Service\Cart;

use App\Models\Cart;
use App\Models\User;

interface ICartService
{
    public static function creatCart($user_id): Cart;
    public static function getCart($user_id);
    public static function deleteCart(User $user, $cart_id);

}
