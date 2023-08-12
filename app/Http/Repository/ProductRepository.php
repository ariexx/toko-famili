<?php

namespace App\Http\Repository;

use App\Models\Product;

class ProductRepository
{
    public function __construct(protected Product $product)
    {
    }

    public function productLists()
    {
        return $this->product->with('category')->simplePaginate(10);
    }

    public function create(array $requestOnly): bool
    {
        $requestOnly['category_uuid'] = $requestOnly['category'];
        $save = $this->product->create($requestOnly);
        if (!$save) {
            return false;
        }
        return true;
    }

}
