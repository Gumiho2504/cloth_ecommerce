<?php

use App\Enums\Role;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Livewire\Auth\Admins\Admin;

use App\Livewire\Auth\Users\Login;
use App\Livewire\Auth\Users\Register;
use App\Livewire\Pages\About;
use App\Livewire\Pages\Category;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\Home;
use App\Livewire\Products\Productshow;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Auth\Users\Profile;

Route::middleware('guest')->group(function () {
    Route::get("/register", Register::class)->name("register");
    Route::get("/login", Login::class)->name("login");
});



Route::middleware('auth')->group(function () {

    Route::get('profile', Profile::class)->name('profile');
    // Volt::route('verify-email', 'pages.auth.verify-email')
    //     ->name('verification.notice');

    // Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
    //     ->middleware(['signed', 'throttle:6,1'])
    //     ->name('verification.verify');

    // Volt::route('confirm-password', 'pages.auth.confirm-password')
    //     ->name('password.confirm');
    Route::get('carts', App\Livewire\Pages\Carts::class)->name('carts');
});




Route::middleware(['auth', 'admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/', Admin::class)->name('dashboard');
});
