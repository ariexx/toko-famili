<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $subTitle = "Dashboard";
    return view('dashboard.admin.index', compact('subTitle'));
});

//Admin Login Route
Route::group(['prefix' => 'admin'], function() {
    Route::get('/login', [\App\Http\Controllers\Admin\LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [\App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin.login.submit');
    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.dashboard');
});
