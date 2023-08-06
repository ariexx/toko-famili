<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\CategoryService;
use Illuminate\Http\Request;
use Alert;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoryService)
    {
    }

    public function index()
    {
        $subTitle = "Category";
        $categories  = $this->categoryService->categoryLists();
        return view('admin.category.index', compact('subTitle', 'categories'));
    }

    public function create(Request $request)
    {
        $requestOnly = $request->only(['name']);

        $save = $this->categoryService->create($requestOnly);
        if (!$save) {
            return redirect()->back();
        }
        return $save;
    }
}
