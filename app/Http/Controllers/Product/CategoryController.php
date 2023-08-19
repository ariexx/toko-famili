<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function __invoke()
    {
        return view('user.pages.category');
    }
}
