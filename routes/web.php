<?php

use App\Http\Controllers\Crud\CategoryController;
use App\Http\Controllers\Crud\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RevenueController;


Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/dashboard/download-pdf', [DashboardController::class, 'downloadPDF'])->name('dashboard.downloadPDF');
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('purchases', PurchaseController::class);
Route::resource('expenses', ExpenseController::class);
Route::resource('revenues', RevenueController::class);
