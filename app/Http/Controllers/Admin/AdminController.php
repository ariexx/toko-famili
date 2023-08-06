<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $subTitle = "Dashboard";
        $username = auth()->user()->name;
        return view('dashboard.admin.index', compact('subTitle', 'username'));
    }
}
