<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $subTitle = "User Dashboard";
        return view('user.dashboard.index', compact('subTitle'));
    }
}
