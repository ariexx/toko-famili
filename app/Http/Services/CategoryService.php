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
}
