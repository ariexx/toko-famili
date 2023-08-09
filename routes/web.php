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
    });
});
