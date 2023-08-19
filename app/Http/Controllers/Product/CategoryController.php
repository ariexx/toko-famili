<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Services\CategoryService;
use App\Http\Services\ProductService;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoryService, protected ProductService $productService)
    {

    }
    public function __invoke()
    {
        $categories = $this->categoryService->categoryLists();
        $products = $this->productService->getAllProducts();
        return view('user.pages.category', compact('categories', 'products'));
    }
}
