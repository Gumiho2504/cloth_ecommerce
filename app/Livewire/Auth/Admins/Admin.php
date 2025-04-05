<?php

namespace App\Livewire\Auth\Admins;

use Livewire\Component;

class Admin extends Component
{
    public function render()
    {
        dd(auth()->user());
        return view('livewire.auth.admins.admin');
    }
}
