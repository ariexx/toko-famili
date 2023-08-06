<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
class LoginController extends Controller
{
    public function showLoginForm()
    {
        $subTitle = "Login";
        return view('admin.login', compact('subTitle'));
    }

    public function login(Request $request)
    {
        $onlyRequest = $request->only(['email', 'password']);
        //validate request
        $validator = \Validator::make($onlyRequest, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //attempt login
        $onlyRequest['level'] = 'admin';
        if (\Auth::attempt($onlyRequest, true)) {
            return redirect()->intended(route('admin.dashboard'));
        }

        alert()->error('Gagal!', "Login Failed");
        //if failed
        return redirect()->back();
    }
}
