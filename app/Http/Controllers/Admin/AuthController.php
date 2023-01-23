<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
   // use AuthenticatesUsers;

    public function login(Request $request)
    {
        return view('admin.auth.login');
    }

    public function dologin(Request $request)

    {

        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))

        {

            if (auth()->user()->is_admin == 1) {

                notify()->success('تم تسجيل الدخول !');

                return redirect()->route('admin.home');

            }else{

                return redirect()->route('admin.login')->with('error','You don\'t have permission to access dashboard.');

            }

        }else{

            return redirect()->route('admin.login')->with('error','Email-Address And Password Are Wrong.');

        }



    }

    public function logout()
    {
        //
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
