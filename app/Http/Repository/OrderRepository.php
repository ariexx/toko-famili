<?php

namespace App\Http\Repository;

use App\Models\Order;

class OrderRepository
{
    public function __construct(protected Order $order)
    {
    }

    public function getOrders()
    {
        return $this->order->with(['products', 'users'])->simplePaginate(10);
    }
}
