<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Admin\AuthController;

/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES (PUBLIC)
|--------------------------------------------------------------------------
*/

Route::get('/', [SiteController::class, 'front'])->name('front');

Route::get('/b2b-sites', [SiteController::class, 'b2b']);
Route::get('/b2c-sites', [SiteController::class, 'b2c']);


Route::get('/allpanel', function () {
    return view('allpanelpage');
})->name('allpanel');

/*
|--------------------------------------------------------------------------
| ADMIN AUTH
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

/*
|--------------------------------------------------------------------------
| ADMIN PANEL (PROTECTED)
|--------------------------------------------------------------------------
*/

Route::middleware(['admin.auth'])->prefix('admin')->group(function () {

    Route::get('/', [SiteController::class, 'admin'])->name('admin');

    Route::post('/store', [SiteController::class, 'store'])->name('sites.store');
    Route::get('/edit/{id}', [SiteController::class, 'edit'])->name('sites.edit');
    Route::post('/update/{id}', [SiteController::class, 'update'])->name('sites.update');
    Route::delete('/delete/{id}', [SiteController::class, 'delete'])->name('sites.delete');

    /* CATEGORY */

    Route::get('/categories', [SiteController::class, 'categories'])->name('categories');
    Route::post('/category/update', [SiteController::class, 'updateCategory'])->name('category.update');
    Route::post('/category/delete', [SiteController::class, 'deleteCategory'])->name('category.delete');
    Route::post('/category/store', [SiteController::class, 'storeCategory'])->name('category.store');

    /* REORDER */

    Route::post('/sites/reorder', [SiteController::class, 'reorder'])->name('sites.reorder');

    /* BULK B2B / B2C */

    Route::post('/sites/bulk-type', [SiteController::class, 'bulkType'])->name('sites.bulk.type');
    /* BLOG PAGE */

    Route::get('/contacts', [SiteController::class, 'contacts'])->name('admin.contacts');

// blog route for admin panel
    Route::get('/blogs', [SiteController::class, 'blogs'])->name('admin.blogs');

    Route::get('/blog/create', [SiteController::class, 'createBlog'])->name('admin.blogs.create');

    Route::post('/blog/store', [SiteController::class, 'blogStore'])->name('blog.store');

    Route::get('/blogs/edit/{id}', [SiteController::class, 'editBlog'])->name('blog.edit');

    Route::post('/blog/update/{id}', [SiteController::class, 'updateBlog'])->name('blog.update');

    Route::delete('/blog/delete/{id}', [SiteController::class, 'blogDelete'])->name('blog.delete');
});

// Frontend Blog Routes
Route::get('/blog', [SiteController::class, 'blogList'])->name('blog');
Route::get('/blog/{slug}', [SiteController::class, 'blogDetail'])->name('blog.detail');



/* CONTACT PAGE */
Route::get('/contact', function () {
    return view('blog.contact'); // resources/views/contact.blade.php
})->name('contact');

Route::post('/contact-submit', [SiteController::class, 'contactSubmit'])->name('contact.submit');