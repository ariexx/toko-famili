<?php

namespace App\Http\Services;

use App\Http\Repository\CategoryRepository;

class CategoryService
{
    public function __construct(protected CategoryRepository $categoryRepository)
    {
    }

    public function categoryLists()
    {
        return $this->categoryRepository->categoryLists();
    }

    public function create(array $data)
    {
        $validator = \Validator::make($data, [
            'name' => 'required|string'
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Category name is required');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        return $this->categoryRepository->create($data);
    }

    public function categoryDetails($uuid): \App\Models\Category
    {
        return $this->categoryRepository->categoryDetails($uuid);
    }

    public function update(array $requestOnly, $uuid)
    {
        $validator = \Validator::make($requestOnly, [
            'name' => 'required|string|unique:categories,name,' . $uuid . ',uuid'
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Category name is required');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        return $this->categoryRepository->update($requestOnly, $uuid);
    }
}
