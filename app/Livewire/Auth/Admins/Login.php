<?php

namespace App\Livewire\Auth\Admins;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect()->route('admin.dashboard');
        }
    }

    public function render()
    {
        //dump(auth()->user());

        return view('livewire.auth.admins.login')->layout('layouts.guest');
    }
}
