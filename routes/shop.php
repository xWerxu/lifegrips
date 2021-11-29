<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::get('/sklep', [CategoryController::class, 'index'])
                ->name('shop');

Route::post('sklep/add-to-cart', [CartController::class, 'addToCart'])
                ->name('add-to-cart');

Route::get('/koszyk', [CartController::class, 'index'])
                ->name('cart');

Route::delete('/koszyk/remove-item', [CartController::class, 'removeItem'])
                ->name('remove-from-cart');

Route::post('/koszyk', [CartController::class, 'updateCart'])
                ->name('update-cart');

Route::get('/koszyk/zamowienie', [OrderController::class, 'makeOrder'])
                ->name('cart.order');