<?php

namespace App\Livewire\Auth\Users;

use Livewire\Component;

class Profile extends Component
{

    public function render()
    {
        return view('livewire.auth.users.profile')->layout('layouts.app');
    }
}
