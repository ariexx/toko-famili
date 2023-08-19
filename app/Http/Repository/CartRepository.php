<?php

namespace App\Http\Repository;

use App\Models\Cart;

class CartRepository
{
    public function __construct(protected Cart $cart)
    {
    }

    public function store(array $data): bool|Cart
    {
        $data['user_uuid'] = \Auth::id();
        //check if product_uuid has exists in carts table
        $productUuidExists = $this->cart
            ->whereUserUuid($data['user_uuid'])
            ->whereProductUuid($data['product_uuid'])->exists();

        if($productUuidExists) return $this->cart
            ->whereUserUuid($data['user_uuid'])
            ->whereProductUuid($data['product_uuid'])
            ->updateOrCreate($data);

        $save = $this->cart->updateOrCreate($data);
        if(!$save) return false;
        return true;
    }

    public function update($data): bool
    {
        //cari uuid nya
        $find = $this->cart->whereProductUuid($data['product_uuid']);
        $save = $find->update(['quantity' => $data['quantity']]);
        if (!$save) return false;
        return true;
    }

    public function userCart()
    {
        return $this->cart->with(['product', 'user'])->whereUserUuid(\Auth::id())->get()->unique('product_uuid');
    }
}
