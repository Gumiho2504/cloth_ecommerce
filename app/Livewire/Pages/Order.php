<?php

namespace App\Livewire\Pages;

use App\Http\Service\Order\OrderService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Order extends Component
{
    public function render()
    {
        $orders = OrderService::getOrders(Auth::id());

        return view('livewire.pages.order', compact('orders'));
    }


    public function deleteOrder($order_id)
    {
        OrderService::deleteOrder(Auth::id(), $order_id);
    }
}
