<?php

use App\Livewire\Products\Productshow;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\About;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Category;




Route::get("/home", Home::class)->name("home");
Route::get("/category", Category::class)->name("category");
Route::get("/about", About::class)->name("about");
Route::get("/contact", Contact::class)->name("contact");
Route::get('/product/{slug}', Productshow::class)->lazy()->name('product.show');



Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/login', App\Livewire\Auth\Admins\Login::class)->name('login');
});


require __DIR__ . '/auth.php';
