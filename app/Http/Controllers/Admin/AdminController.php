<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\OrderService;
use App\Http\Services\ProductService;

class AdminController extends Controller
{
    public function __construct
    (
        protected ProductService $productService,
        protected OrderService $orderService,
    )
    {
    }

    public function index()
    {
        $subTitle = "Dashboard";
        $username = auth()->user()->name;
        $totalEarnings = $this->orderService->totalEarnings();
        $totalOrders = $this->orderService->totalOrders();
        $totalProducts = $this->productService->totalProducts();
        $totalUsers = $this->orderService->totalUsers();
        $orderLists = $this->orderService->getOrders();
        $chartData = $this->orderService->chartData();
        return view('dashboard.admin.index', compact(
            'subTitle',
            'username',
            'totalEarnings',
            'totalOrders',
            'totalProducts',
            'totalUsers',
            'orderLists',
            'chartData',
        ));
    }
}
