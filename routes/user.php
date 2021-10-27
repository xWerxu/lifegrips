<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

Route::get('/profile', [UsersController::class, 'index'])
                ->middleware('auth')
                ->name('user.profile');