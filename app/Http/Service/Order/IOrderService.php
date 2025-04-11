<?php

namespace App\Http\Service\Order;

use App\Models\Cart;

interface IOrderService
{
    public static function placeOrder($user_id);
    public static function getOrders($user_id);
    ///public  function createOrder(Cart $cart);
    public static function deleteOrder($user_id, $order_id);
}
