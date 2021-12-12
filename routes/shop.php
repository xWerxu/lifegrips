<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShopController;

Route::get('/sklep', [ShopController::class, 'index'])
                ->name('shop');

Route::post('/sklep/add-to-cart', [CartController::class, 'addToCart'])
                ->name('add-to-cart');

Route::get('/koszyk', [CartController::class, 'index'])
                ->name('cart');

Route::delete('/koszyk/remove-item', [CartController::class, 'removeItem'])
                ->name('remove-from-cart');

Route::post('/koszyk', [CartController::class, 'updateCart'])
                ->name('update-cart');

Route::get('/koszyk/zamowienie', [OrderController::class, 'makeOrder'])
                ->name('cart.order');

Route::post('/koszyk/zamowienie', [OrderController::class, 'postOrder'])
                ->name('cart.post-order');

Route::get('/sklep/produkt/{id}', [ShopController::class, 'product'])
                ->name('shop.product');

Route::get('/wpis/{id}', [ShopController::class, 'showArticle'])
                ->name('shop.article');

Route::get('/sklep/kategoria/{id}', [ShopController::class, 'category' ])
                ->name('shop.category');