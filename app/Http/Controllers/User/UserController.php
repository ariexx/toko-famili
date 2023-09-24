<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;

class UserController extends Controller
{
    public function index()
    {
        $subTitle = "User Dashboard";
        //get total order user
        $totalOrder = Order::where('user_uuid', \Auth::id())->count();
        $dataOrders = Order::where('user_uuid', \Auth::id())->orderBy('uuid', 'desc')->simplePaginate(5);
        return view('user.dashboard.index', compact('subTitle', 'totalOrder', 'dataOrders'));
    }
}
