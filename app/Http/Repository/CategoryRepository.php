<?php

namespace App\Http\Repository;


use App\Models\Category;
use App\Models\User;

class CategoryRepository
{
    public function __construct(protected Category $category){ }

    public function categoryLists()
    {
        return $this->category->simplePaginate(10);
    }

    public function create(array $data)
    {
        $save = $this->category->create($data);
        if ($save) {
            alert()->success('Success', 'Category created successfully');
            return redirect()->back();
        }

        alert()->error('Error', 'Category creation failed');
    }

    public function categoryDetails($uuid): Category
    {
        return $this->category->where('uuid', $uuid)->firstOrFail();
    }

    public function update(array $requestOnly, $uuid): bool
    {
        $update = $this->category->whereUuid($uuid)->update($requestOnly);
        if ($update) {
            return true;
        } else {
            return false;
        }
    }
}
