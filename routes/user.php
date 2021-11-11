<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

Route::get('/profile', [UsersController::class, 'index'])
                ->middleware('auth')
                ->name('user.profile');

Route::put('/profile', [UsersController::class, 'update'])
                ->middleware('auth')
                ->name('user.update');