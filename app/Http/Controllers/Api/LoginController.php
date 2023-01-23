<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use App\Traits\GeneralTrait;
use Validator;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    use GeneralTrait;



    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
         $user = User::Where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->returnError('407', "These credentials do not match our recourd");
        }
        $user->token = $user->createToken('my-app-token')->plainTextToken;
        return $this->returnData('user', $user);
    }

    public function logout(Request $request){
         if ($request->user()) {
           Auth::user()->tokens()->delete();
        return $this->returnSuccessMessage("logg out success");
    }

    }

    public function postRegister(Request $request)
    {
    $validator = Validator::make($request->all(), [
        'fname' => 'required',
        'lname' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8',
        ],$messages = [
            'email.unique' => 'البريد الالكتروني مستخدم بالفعل!',
            'email.required' => 'البريد الالكتروني مطلوب!',
            'fname.required' => 'الاسم مطلوب',
            'lname.required' => 'الاسم مطلوب',
            'password.required' => 'كلمة المرور مطلوبة',
        ]);

       if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $data = $request->all();

//        $image = null;
//        if($request->hasFile('image') && $request->file('image')->isValid()){
//            $image = $request->file('image')->store('ProfileImages','public');
//        }
//        $data['image'] = $image;

        $user = User::create([
        'fname' => $data['fname'],
        'lname' => $data['lname'],
        'email' => $data['email'],
//        'image' => $data['image'],
        'password' => Hash::make($data['password']),
        'status' => '1',
        'type' => '1'
      ]);

        $user->token = $user->createToken('my-app-token')->plainTextToken;
        return $this->returnData('user', $user);
    }
    public function changePassword(Request $request){

         if ($request->user()) {
            $user = Auth::user();

            $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'new_confirm_password' => 'same:new_password',
        ]);

            if(Hash::check($request->current_password, $user->password)){
                $user->update(['password'=> Hash::make($request->new_password)]);
                return $this->returnSuccessMessage("Password Updated");

            }
         }
    }

    public function changeinfo(Request $request){

    }

}
