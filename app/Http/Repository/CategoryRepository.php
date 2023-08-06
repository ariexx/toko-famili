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
}
