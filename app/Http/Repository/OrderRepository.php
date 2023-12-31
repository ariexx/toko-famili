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
        return $this->order->with(['orderDetails', 'orderDetails.product', 'users'])->simplePaginate(10);
    }

    public function totalEarnings()
    {
        return $this->order->orderDetails()->sum('total');
    }

    public function totalOrders()
    {
        return $this->order->count();
    }

    public function totalUsers()
    {
        return $this->order->distinct('user_uuid')->count('user_uuid');
    }

    public function chartData()
    {
        return $this->order->orderDetails()->selectRaw('DATE(created_at) as date, sum(total) as total')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();
    }
}
