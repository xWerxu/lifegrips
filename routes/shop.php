<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

Route::get('/sklep', [CategoryController::class, 'index'])
                ->name('shop');

Route::get('sklep/add-to-cart', [CartController::class, 'addToCart'])
                ->name('add-to-cart');