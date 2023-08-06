<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "Hello World";
});

//Admin Login Route
Route::group(['prefix' => 'admin'], function() {
    Route::get('/login', [\App\Http\Controllers\Admin\LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [\App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin.login.submit');
    Route::middleware(['AdminMiddleware'])->group(function() {
        //logout
        Route::post('/logout', [\App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('admin.logout');
        Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/category', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.category');
    });
});
