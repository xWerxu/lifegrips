<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VariantController;
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

Route::get('/admin/produkty', [ProductController::class, 'adminIndex'])
                ->middleware('admin')
                ->name('admin.product.index');

Route::get('/admin/produkty/nowy', [ProductController::class, 'create'])
                ->middleware('admin')
                ->name('admin.product.create');

Route::post('/admin/produkty/nowy', [ProductController::class, 'postCreate'])
                ->middleware('admin')
                ->name('admin.product.create');

Route::delete('/admin/produkty/usun', [ProductController::class, 'delete'])
                ->middleware('admin')
                ->name('admin.product.delete');

Route::get('/admin/produkty/{id}', [ProductController::class, 'edit'])
                ->middleware('admin')
                ->name('admin.product.edit');

Route::put('/admin/produkty/edytuj', [ProductController::class, 'postEdit'])
                ->middleware('admin')
                ->name('admin.product.update');

Route::get('/admin/warianty/{product_id}/dodaj', [VariantController::class, 'create'])
                ->middleware('admin')
                ->name('admin.variant.create');

Route::post('/admin/warianty/nowy', [VariantController::class, 'postCreate'])
                ->middleware('admin')
                ->name('admin.variant.postCreate');

Route::delete('/admin/warianty/usun', [VariantController::class, 'delete'])
                ->middleware('admin')
                ->name('admin.variant.delete');

Route::get('/admin/warianty/edytuj/{id}', [VariantController::class, 'edit'])
                ->middleware('admin')
                ->name('admin.variant.edit');

Route::put('/admin/warianty/edytuj', [VariantController::class, 'postEdit'])
                ->middleware('admin')
                ->name('admin.variant.update');

Route::get('/admin/dostawy', [ShipmentController::class, 'index'])
                ->middleware('admin')
                ->name('admin.shipment.index');

Route::post('/admin/dostawy', [ShipmentController::class, 'create'])
                ->middleware('admin')
                ->name('admin.shipment.create');

Route::delete('/admin/dostawy', [ShipmentController::class, 'delete'])
                ->middleware('admin')
                ->name('admin.shipment.delete');

Route::put('/admin/dostawy', [ShipmentController::class, 'update'])
                ->middleware('admin')
                ->name('admin.shipment.update');

Route::get('/admin/platnosci', [PaymentController::class, 'index'])
                ->middleware('admin')
                ->name('admin.payment.index');

Route::post('/admin/platnosci', [PaymentController::class, 'create'])
                ->middleware('admin')
                ->name('admin.payment.create');

Route::delete('/admin/platnosci', [PaymentController::class, 'delete'])
                ->middleware('admin')
                ->name('admin.payment.delete');

Route::put('/admin/platnosci', [PaymentController::class, 'update'])
                ->middleware('admin')
                ->name('admin.payment.update');

Route::get('/admin/kody-rabatowe', [CouponController::class, 'index'])
                ->middleware('admin')
                ->name('admin.coupon.index');

Route::post('/admin/kody-rabatowe', [CouponController::class, 'create'])
                ->middleware('admin')
                ->name('admin.coupon.create');

Route::delete('/admin/kody-rabatowe', [CouponController::class, 'delete'])
                ->middleware('admin')
                ->name('admin.coupon.delete');

Route::put('/admin/kody-rabatowe', [CouponController::class, 'update'])
                ->middleware('admin')
                ->name('admin.coupon.update');

Route::get('/admin/zamowienia', [OrderController::class, 'adminIndex'])
                ->middleware('admin')
                ->name('admin.order.index');

Route::get('/admin/zamowienia/{id}', [OrderController::class, 'edit'])
                ->middleware('admin')
                ->name('admin.order.edit');

Route::put('/admin/zamowienia/{id}', [OrderController::class, 'update'])
                ->middleware('admin')
                ->name('admin.order.update');

Route::get('/admin/klienci', [UsersController::class, 'adminIndex'])
                ->middleware('admin')
                ->name('admin.customer.index');

Route::get('/admin/klienci/{id}', [UsersController::class, 'adminShow'])
                ->middleware('admin')
                ->name('admin.customer.show');

Route::get('/admin/wpisy', [ArticleController::class, 'index'])
                ->middleware('admin')
                ->name('admin.article.index');

Route::get('/admin/wpisy/nowy', [ArticleController::class, 'create'])
                ->middleware('admin')
                ->name('admin.article.create');

Route::post('/admin/wpisy/nowy', [ArticleController::class, 'postCreate'])
                ->middleware('admin')
                ->name('admin.article.create');

Route::delete('/admin/wpisy/usun', [ArticleController::class, 'delete'])
                ->middleware('admin')
                ->name('admin.article.delete');

Route::get('/admin/wpisy/{id}', [ArticleController::class, 'edit'])
                ->middleware('admin')
                ->name('admin.article.edit');

Route::put('/admin/wpisy', [ArticleController::class, 'update'])
                ->middleware('admin')
                ->name('admin.article.update');

Route::get('/admin/filtry', [FilterController::class, 'index'])
                ->middleware('admin')
                ->name('admin.filter.index');

Route::get('/api/find-filter', [FilterController::class, 'findFilter'])
                ->name('api.find-filter');

Route::post('/admin/filtry', [FilterController::class, 'create'])
                ->middleware('admin')
                ->name('admin.filter.create');

Route::delete('/admin/filtry', [FilterController::class, 'delete'])
                ->middleware('admin')
                ->name('admin.filter.delete');

Route::put('/admin/filtry', [FilterController::class, 'update'])
                ->middleware('admin')
                ->name('admin.filter.update');

Route::get('/admin/pracownicy', [UsersController::class, 'employees'])
                ->middleware('actualAdmin')
                ->name('admin.employees.index');

Route::put('/admin/pracownicy', [UsersController::class, 'updateEmployee'])
                ->middleware('actualAdmin')
                ->name('admin.employees.updateEmployee');