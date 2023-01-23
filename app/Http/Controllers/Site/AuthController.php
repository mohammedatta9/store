<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    use GeneralTrait;

    public function getLoginPage()
    {
        return view('site.auth.loginPage');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],
            $messages = [
                'email.required' => 'البريد الالكتروني مطلوب!',
                'password.required' => 'كلمة المرور مطلوبة',
            ]
        );
        $user = User::Where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->to('loginPage')->withErrors($messages);
        }
        notify()->success('   ');
        return redirect()->route('viewMyAccount');
    }

    public function getRegisterPage()
    {
        return view('site.auth.registerPage');
    }

    //
}
