<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Product as ProductModel;
use App\Http\Controllers\AuthController as AuthController;
use App\Http\Controllers\ReportController as ReportController;

Route::get('/', [ProductController::class, 'index'])->name('index');

Route::get('/shopping-cart', [ShoppingCartController::class, 'index'])->name('shopping-cart')->middleware('auth');
Route::post('/add-to-cart', [ShoppingCartController::class, 'addToCart'])->name('add-to-cart')->middleware('auth');
Route::get('/remove-from-cart', [ShoppingCartController::class, 'removeFromCart'])->name('remove-from-cart')->middleware('auth');
Route::post('/checkout', [ShoppingCartController::class, 'checkout'])->name('checkout')->middleware('auth');

//Auth
Route::group(['prefix' => 'auth'], function () {
    Route::get('/', [AuthController::class, 'index'])->name('auth.index');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'store'])->name('auth.store');
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

// Relatórios
Route::get('/admin/reports', [ReportController::class, 'generate_report'])->name('admin.reports')->middleware('auth');