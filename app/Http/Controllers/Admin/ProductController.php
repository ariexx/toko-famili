<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\ProductService;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService)
    {
    }

    public function index()
    {
        $subTitle = "Product";
        $products = $this->productService->productLists();
        $categories = Category::all();
        return view('admin.product.index', compact('subTitle', 'products', 'categories'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $requestOnly = $request->only(['name', 'category', 'price', 'quantity', 'description', 'image']);
        $save = $this->productService->create($requestOnly);
        if (!$save) {
            alert()->error('Error', 'Product create failed');
            return redirect()->back();
        }

        alert()->success('Success', 'Product created successfully');
        return redirect()->back();
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $subTitle = "Product";
        $product = $this->productService->productDetails($id);
        $categories = Category::all();
        return view('admin.product.edit', compact('subTitle', 'product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $requestOnly = $request->only(['name', 'category', 'price', 'quantity', 'description']);
        $update = $this->productService->update($requestOnly, $id);
        if (!$update) {
            alert()->error('Error', 'Product update failed');
            return redirect()->back();
        }
        alert()->success('Success', 'Product updated successfully');
        return redirect()->route('admin.product');
    }

    public function destroy($id)
    {
        $product = $this->productService->productDetails($id);
        $product->delete();
        alert()->success('Success', 'Product deleted successfully');
        return redirect()->back();
    }
}
