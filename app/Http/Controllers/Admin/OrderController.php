<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\OrderService;

class OrderController
{

    public function __construct(protected OrderService $orderService)
    {
    }

    public function index()
    {
        $subTitle = 'Order List';
        $orders = $this->orderService->getOrders();
        return view('admin.order.index', compact('subTitle', 'orders'));
    }

    public function store(Request $request)
    {

    }

    public function edit($uuid)
    {

    }

    public function update(Request $request, $uuid)
    {

    }


    public function destroy($uuid)
    {

    }

}
