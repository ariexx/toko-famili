<?php

namespace App\Http\Services;

use App\Http\Repository\OrderRepository;

class OrderService
{

    public function __construct(protected OrderRepository $orderRepository)
    {
    }

    public function getOrders()
    {
        return $this->orderRepository->getOrders();
    }

}
