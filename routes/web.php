<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route("login");
});

Route::get('404', function () {
    abort(404);
});

//Auth Route
Route::get('/login', [\App\Http\Controllers\Admin\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin.login.submit');

//Admin Login Route
Route::group(['prefix' => 'admin'], function() {
    Route::middleware(['auth'])->group(function() {
        //logout
        Route::post('/logout', [\App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('admin.logout');
        Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.dashboard');

        //category
        Route::group(['prefix' => 'category'], function (){
            Route::get('/', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.category');
            Route::post('/create', [\App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin.category.create');
            Route::get('/edit/{uuid}', [\App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('admin.category.edit');
            Route::put('/update/{uuid}', [\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin.category.update');
            Route::delete('/delete/{uuid}', [\App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('admin.category.delete');
        });

        //product
        Route::group(['prefix' => 'product'], function (){
            Route::get('/', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.product');
            Route::post('/create', [\App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.product.store');
            Route::get('/edit/{uuid}', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.product.edit');
            Route::put('/update/{uuid}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.product.update');
            Route::delete('/delete/{uuid}', [\App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('admin.product.delete');
        });

        //order
        Route::group(['prefix' => 'order'], function (){
            Route::get('/', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.order');
            Route::get('/detail/{uuid}', [\App\Http\Controllers\Admin\OrderController::class, 'detail'])->name('admin.order.detail');
            Route::put('/update/{uuid}', [\App\Http\Controllers\Admin\OrderController::class, 'update'])->name('admin.order.update');
            Route::delete('/delete/{uuid}', [\App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('admin.order.delete');
        });
    });
});
