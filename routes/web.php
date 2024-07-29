<?php

use App\Livewire\ProductList;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', ProductList::class)->name('products.index');

