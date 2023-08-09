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
        $credentials = $request->only(['email', 'password']);

        $validator = \Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Validator Failed');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if(auth()->attempt($credentials)) {
            if(auth()->user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }else{
                //return to user dashboard
                dd("not admin");
            }
        }

        alert()->error('Error', 'Login Failed');
        return redirect()->back()->withInput()->withErrors(['email' => 'These credentials do not match our records.']);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
