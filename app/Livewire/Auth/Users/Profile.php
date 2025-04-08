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

    

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    }
}
