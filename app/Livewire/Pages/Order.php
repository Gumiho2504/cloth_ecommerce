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
        dump($orders);
        return view('livewire.pages.order', compact('orders'));
    }
}
