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

    public function totalEarnings()
    {
        return $this->orderRepository->totalEarnings();
    }

    public function totalOrders()
    {
        return $this->orderRepository->totalOrders();
    }

    public function totalUsers()
    {
        return $this->orderRepository->totalUsers();
    }

    public function chartData()
    {
        $orders = $this->orderRepository->chartData();
        $data = [];
        foreach ($orders as $order) {
            $data[] = [
                'date' => $order->date,
                'total' => $order->total,
            ];
        }
        return $data;
    }

}
