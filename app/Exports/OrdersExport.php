<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class OrdersExport implements FromView
{
    public function view(): \Illuminate\Contracts\View\View
    {
        $orders = Order::with('orderDetails', 'orderDetails.product', 'users')->get();
        return view('admin.order.export', compact('orders'));
    }
}
