<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $subTitle = "Category";
        return view('admin.category.index', compact('subTitle'));
    }
}
