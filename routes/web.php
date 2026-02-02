<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Admin\AuthController;

// Front Page
Route::get('/', [SiteController::class, 'front'])->name('front');

// Admin Authentication Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

// Protected Admin Routes
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/', [SiteController::class, 'admin'])->name('admin');
    Route::post('/store', [SiteController::class, 'store'])->name('sites.store');
    Route::get('/edit/{id}', [SiteController::class, 'edit'])->name('sites.edit');
    Route::post('/update/{id}', [SiteController::class, 'update'])->name('sites.update');
    Route::delete('/delete/{id}', [SiteController::class, 'delete'])->name('sites.delete');


  // routes/web.php
Route::get('/admin/categories',[SiteController::class,'categories'])->name('categories');
Route::post('/admin/category/update',[SiteController::class,'updateCategory'])->name('category.update');
Route::post('/admin/category/delete',[SiteController::class,'deleteCategory'])->name('category.delete');
Route::post('/category/store', [SiteController::class, 'storeCategory'])
    ->name('category.store');


});