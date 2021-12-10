<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

Route::get('/profile', [UsersController::class, 'index'])
                ->middleware('verified')
                ->name('user.profile');

Route::put('/profile', [UsersController::class, 'update'])
                ->middleware('verified')
                ->name('user.update');