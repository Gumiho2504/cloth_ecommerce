<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Livewire\Auth\Users\Register;
use App\Livewire\Pages\About;
use App\Livewire\Pages\Category;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\Home;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Route::get("/register", Register::class)->name("register");

    // Volt::route('login', 'pages.auth.login')
    //     ->name('login');

    // Volt::route('forgot-password', 'pages.auth.forgot-password')
    //     ->name('password.request');

    // Volt::route('reset-password/{token}', 'pages.auth.reset-password')
    //     ->name('password.reset');
    Route::get("/home", Home::class)->name("home");
    Route::get("/category", Category::class)->name("category");
    Route::get("/about", About::class)->name("about");
    Route::get("/contact", Contact::class)->name("contact");
});

Route::middleware('auth')->group(function () {
    // Volt::route('verify-email', 'pages.auth.verify-email')
    //     ->name('verification.notice');

    // Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
    //     ->middleware(['signed', 'throttle:6,1'])
    //     ->name('verification.verify');

    // Volt::route('confirm-password', 'pages.auth.confirm-password')
    //     ->name('password.confirm');
});


// Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
//     Route::get('/dashboard', Dashboard::class)->name('admin.dashboard');
// });
