<?php

namespace App\Http\Services;

use App\Http\Repository\ProductRepository;
use Illuminate\Support\Collection;

class ProductService
{
    public function __construct(protected ProductRepository $productRepository)
    {
    }

    public function getAllProducts(): array|\Illuminate\Database\Eloquent\Collection
    {
        return $this->productRepository->getAllProducts();
    }

    public function productLists()
    {
        return $this->productRepository->productLists();
    }

    public function create(array $requestOnly): bool
    {

        //store image
        $image = $requestOnly['image'];
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);
        $requestOnly['image'] = $imageName;

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
        //check image is exist or not
        if (isset($requestOnly['image'])) {
            //store image
            $image = $requestOnly['image'];
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $requestOnly['image'] = $imageName;
        }
        $update = $this->productRepository->update($requestOnly, $id);
        if (!$update) {
            return false;
        }
        return true;
    }

    public function getOrders()
    {
        return $this->productRepository->getOrders();
    }

    public function totalProducts()
    {
        return $this->productRepository->totalProducts();
    }
}
