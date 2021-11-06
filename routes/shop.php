<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/sklep', [CategoryController::class, 'index'])
                ->name('shop');