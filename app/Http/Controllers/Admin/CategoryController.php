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
    public function edit($uuid)
    {
        $subTitle = "Category";
        $category = $this->categoryService->categoryDetails($uuid);
        return view('admin.category.edit', compact('subTitle', 'category'));
    }

    public function update(Request $request, $uuid)
    {
        $requestOnly = $request->only(['name']);
        $update = $this->categoryService->update($requestOnly, $uuid);
        if (!$update) {
            alert()->error('Error', 'Category update failed');
            return redirect()->back();
        }
        alert()->success('Success', 'Category updated successfully');
        return redirect()->route('admin.category');
    }

    public function delete($uuid)
    {
        $category = $this->categoryService->categoryDetails($uuid);
        $category->delete();
        alert()->success('Success', 'Category deleted successfully');
        return redirect()->back();
    }
}
