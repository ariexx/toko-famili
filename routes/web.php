<?php

use Illuminate\Support\Facades\Route;


Route::get('404', function () {
    abort(404);
});

//Auth Route
Route::get('/login', [\App\Http\Controllers\Admin\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin.login.submit');

//Register Route
Route::get('/register', [\App\Http\Controllers\RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [\App\Http\Controllers\RegisterController::class, 'register'])->name('register.submit');

//User Route
Route::group(['prefix' => 'user'], function () {
    Route::middleware('auth')->group(function () {
       Route::get('/dashboard', [\App\Http\Controllers\User\UserController::class, 'index'])->name('user.dashboard');

       //User Profile
         Route::group(['prefix' => 'profile'], function () {
              Route::get('/', [\App\Http\Controllers\User\ProfileController::class, 'index'])->name('user.profile');
              Route::put('/update', [\App\Http\Controllers\User\ProfileController::class, 'update'])->name('user.profile.update');
         });
    });
});

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

//Guest
Route::group([], function () {
    Route::get('/', function () {
        return view('user.pages.main');
    })->name('user.main');

    //category
    Route::get('/category', \App\Http\Controllers\Product\CategoryController::class)->name('product.category');

    //Cart
    Route::group(['prefix' => 'carts', 'middleware' => ['auth']], function () {
        Route::get('/', [\App\Http\Controllers\Cart\CartController::class, 'index'])->name('cart.index');
        Route::middleware('throttle:web')->post('/store', [\App\Http\Controllers\Cart\CartController::class, 'store'])->name('cart.store');
    });

    //Checkout
    Route::group(['prefix' => 'checkout', 'middleware' => ['auth']], function () {
        Route::post('/store', [\App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
    });
});

//callback tripay
Route::post('/callback', [\App\Http\Controllers\Payment\PaymentController::class, 'callback'])->name('callback');
