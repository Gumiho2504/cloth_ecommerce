<?php

namespace App\Livewire\Auth\Users;

use App\Http\Service\Cart\CartItemService;
use App\Http\Service\Cart\CartService;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{
    public function mount() {}

    public function render()
    {
        return view('livewire.auth.users.profile')->layout('layouts.app');
    }

    public function deleteCardItem($id)
    {
        CartItemService::deleteCartItems($id);
        auth()->user()->carts()->first()->update(['total_amount' => auth()->user()->carts()->first()->cartItems()->sum('total_price')]);
    }

    public function deleteCart($cartId)
    {
        $user = Auth::user();
        CartService::deleteCart($user, $cartId);
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    }
}
