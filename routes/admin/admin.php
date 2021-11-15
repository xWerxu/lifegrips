<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', [AdminController::class, 'index'])
                ->middleware('admin')
                ->name('admin.panel');

Route::get('/admin/kategorie', [CategoryController::class, 'adminIndex'])
                ->middleware('admin')
                ->name('admin.category.index');

Route::post('/admin/kategorie/nowa', [CategoryController::class, 'create'])
                ->middleware('admin')
                ->name('admin.category.create');

Route::delete('/admin/kategorie/', [CategoryController::class, 'delete'])
                ->middleware('admin')
                ->name('admin.category.delete');

Route::put('/admin/kategorie/edytuj', [CategoryController::class, 'update'])
                ->middleware('admin')
                ->name('admin.category.update');

Route::get('/admin/produkty/nowy', [ProductController::class, 'create'])
                ->middleware('admin')
                ->name('admin.product.create');

Route::post('/admin/produkty/nowy', [ProductController::class, 'postCreate'])
                ->middleware('admin')
                ->name('admin.product.create');