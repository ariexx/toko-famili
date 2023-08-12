<?php

namespace App\Http\Services;

use App\Http\Repository\ProductRepository;

class ProductService
{
    public function __construct(protected ProductRepository $productRepository)
    {
    }

    public function productLists()
    {
        return $this->productRepository->productLists();
    }

    public function create(array $requestOnly): bool
    {
        $save = $this->productRepository->create($requestOnly);
        if (!$save) {
            return false;
        }
        return true;
    }

    public function productDetails($id)
    {
        return $this->productRepository->productDetails($id);
    }

    public function update(array $requestOnly, $id)
    {
        $update = $this->productRepository->update($requestOnly, $id);
        if (!$update) {
            return false;
        }
        return true;
    }
}
