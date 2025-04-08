<?php

namespace App\Http\Service\Cart;


interface ICartItemService
{
    public static function addItemToCart($cart_id, $product_id,$color_id,$size_id, $uni_price, $quantity);
    public static function deleteCartItems($item_id, $cart_id);
    public static function updateQuantity($quantity, $item_id, $cart_id);
}
