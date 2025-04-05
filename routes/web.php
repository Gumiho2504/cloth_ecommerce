<?php

use App\Livewire\Products\Productshow;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/home', 301);

Route::get('/product/{slug}', Productshow::class)->lazy()->name('product.show');
require __DIR__ . '/auth.php';
