<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $subTitle = "Profile";
        $user = \Auth::user();
        $userDetail = $user->userDetail;
        return view('user.dashboard.profile.index', compact('subTitle', 'user', 'userDetail'));
    }

    public function update(Request $request)
    {
        $only = $request->only(['name', 'email', 'detail_address']);

        $user = \Auth::user();
        $user->name = $only['name'];
        $user->email = $only['email'];
        $user->save();

        //update or create user detail
        $userDetail = $user->userDetail;
        if (!$userDetail) {
            $user->userDetail()->create([
                'street_detail' => $only['detail_address']
            ]);
        } else {
            $userDetail->street_detail = $only['detail_address'];
            $userDetail->save();
        }

        alert()->success('Success', 'Profile updated successfully');
        return redirect()->back();
    }
}
