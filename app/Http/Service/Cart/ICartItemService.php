<?php

namespace App\Http\Service\Cart;


interface ICartItemService
{
    public static function addItemToCart($cart_id, $product_id, $uni_price, $quantity);
    public static function deleteCartItems($item_id);
}
