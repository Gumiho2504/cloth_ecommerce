<?php

namespace App\Livewire\Auth\Users;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class Login extends Component
{
    public $email;
    public $password;
    public $errorMessage;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required', // Add minimum length for security
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $this->reset(['email', 'password', 'errorMessage']); // Clear form fields
            session()->flash('success', 'Welcome back!');
            return $this->redirectRoute('profile', navigate: true);
        } else {
            $this->errorMessage = 'Invalid email or password.';
            $this->reset('password'); // Clear password field for security
        }
    }

    public function render()
    {
        if (Auth::guard('web')->check()) {
            return $this->redirectRoute('profile', navigate: true);
        }
        return view('livewire.auth.users.login');
    }
}
