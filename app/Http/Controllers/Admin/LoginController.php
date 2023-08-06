<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\LoginServices;
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
        $credentials = $request->only(['email', 'password']);

        $validator = \Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Validator Failed');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if(\Auth::attempt($credentials, true)) {
            //regenerate session
            $request->session()->regenerate();
            return redirect()->to(route('admin.dashboard'));
        }

        alert()->error('Error', 'Login Failed');
        return redirect()->back()->withInput()->withErrors(['email' => 'These credentials do not match our records.']);
    }

    public function logout()
    {
        \Auth::logout();
        return redirect()->route('admin.login');
    }
}
