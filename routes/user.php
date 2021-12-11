<?php

use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

Route::get('/profil', [UsersController::class, 'index'])
                ->middleware('verified')
                ->name('user.profile');

Route::put('/profil', [UsersController::class, 'update'])
                ->middleware('verified')
                ->name('user.update');

Route::get('/profil/zamowienie/{id}', [ShopController::class, 'showOrder'])
                ->middleware('verified')
                ->name('profile.show-order');