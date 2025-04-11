<?php

namespace   App\Http\Service\Order;

use App\Enums\OrderStatus;
use App\Http\Service\Cart\CartService;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\Gate;

class OrderService implements IOrderService
{
    public static function placeOrder($user_id)
    {
        Gate::authorize('create', Order::class);
        $cart = CartService::getCart($user_id);

        if ($cart->cartItems->count() > 0) {
            $order = self::createOrder($cart);
            self::createOrderItems($order, $cart);
            CartService::deleteCart($user_id, $cart->id);
            return $order;
        }
        return null;
    }

    public static function getOrders($user_id)
    {

        $orders = Order::with('orderItems')->where('user_id', $user_id)->get();
        foreach ($orders as $order) {
            Gate::authorize('view', $order);
        }

        return $orders;
    }


    public static  function createOrder(Cart $cart)
    {
        $order  = Order::create([
            'user_id' => $cart->user_id,
            'status' => OrderStatus::PENDING,
            'total_amount' => $cart->total_amount
        ]);
        return $order;
    }

    public static function createOrderItems($order, $cart)
    {
        $orderItems = [];
        foreach ($cart->cartItems as $item) {

            $itemOrder = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'color_id' => $item->color_id,
                'size_id' => $item->size_id,
                'quantity' => $item->quantity,
                'price' => $item->total_price
            ]);

            $stock = ProductVariation::where('product_id', $item->product_id)
                ->where('color_id', $item->color_id)->where('size_id', $item->size_id)->first();

            // if ($stock->stock < $item->quantity) {
            //     //dd("ff");
            //     return redirect()->back()->with('error', 'Out of stock');
            // }


            ProductVariation::where('product_id', $item->product_id)
                ->where('color_id', $item->color_id)->where('size_id', $item->size_id)
                ->decrement('stock', $item->quantity);

            $orderItems[] = $itemOrder;
        }
        return $orderItems;
    }


    public static function deleteOrder($user_id, $order_id)
    {
        $order = Order::findOrFail($order_id);
        Gate::authorize('delete', $order);
        $order->delete();
    }
}
