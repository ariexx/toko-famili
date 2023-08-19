<?php

namespace App\Http\Services;

use App\Http\Repository\CartRepository;

class CartService extends Service
{
    public function __construct(protected CartRepository $cartRepository)
    {
    }

    public function store($data): mixed
    {
        if(empty($data['quantity'])) $data['quantity'] = 1;
        if(!empty($data['type']) && $data['type'] == "update") {
            return $this->cartRepository->update($data);
        }
        $save = $this->cartRepository->store($data);
        if(!$save) return $this->failResponse();
        return $this->successResponse();
    }

    public function getUserCart()
    {
        return $this->cartRepository->userCart();
    }
}
