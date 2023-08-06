<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $subTitle = "Dashboard";
    return view('dashboard.admin.index', compact('subTitle'));
});
