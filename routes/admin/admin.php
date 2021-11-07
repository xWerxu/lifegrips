<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/admin', [AdminController::class, 'index'])
                ->middleware('admin')
                ->name('admin.panel');