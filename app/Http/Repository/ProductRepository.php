<?php

namespace App\Http\Repository;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

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

    public function productDetails($id)
    {
        return $this->product->with('category')->whereUuid($id)->firstOrFail();
    }

    public function update(array $requestOnly, $id)
    {
        $requestOnly['category_uuid'] = $requestOnly['category'];
        unset($requestOnly['category']);
        $update = $this->product->whereUuid($id)->update($requestOnly);
        if (!$update) {
            return false;
        }
        return true;
    }

    public function getOrders()
    {
        return $this->product->with('category')->simplePaginate(10);
    }

    public function totalProducts()
    {
        return $this->product->count();
    }

    public function getAllProducts($filter): Collection
    {
        if ($filter == 'best-seller') {
            //get best seller products based on order count
            return $this->product->with('category')->withCount('orderDetail')->orderBy('order_detail_count', 'desc')->get();
        }

        return $this->product->with('category')->orderBy('name', 'desc')->get();
    }

    public function search($search): Collection
    {
        return $this->product->with('category')->where('name', 'like', '%' . $search . '%')->get();
    }
}
