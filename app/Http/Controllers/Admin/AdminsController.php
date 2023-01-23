<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Validation\Rules;
use File;

class AdminsController extends Controller
{
    //
   
    public function admins_list()
    {
        $admins = User::where('is_admin', 1)->get();
        return view('admin.admins.index')->with('admins', $admins);
    }
    
    public function add()
    {  
         return view('admin.admins.add') ;
    }
    public function admin_store(Request $request)
    {
        $request->validate([ 
            'email' => ['required', 'string', 'email','email:rfc' , 'max:255', 'unique:users'],
            'password' => ['required','confirmed', Rules\Password::defaults()],
            
        ],
            [ 
                'email.required' => 'الايميل مطلوب',
                'email.unique' => ' الايميل مستخدم من قبل',
                'password.confirmed' => 'كلمة المرور غير متطابقة',
                'password.required' => 'كلمة المرور مطلوبة'
                
            ]); 
        $user = User::create([
            'email' => $request->email,
            'fname' => $request->first_name,
            'password' => Hash::make($request->password),
            'status' => '1',
            'is_admin' => '1',
            'type' => '1',
            
        ]);

        notify()->success('تمت اضافة مشرف   !');
            return redirect()->back();
    
    }
    
    public function admin_profile($id)
    {
        $mentors = User::where('id', $id)->first(); 
         return view('admin.admins.profile')->with('mentor', $mentors) ;
    }

    public function admin_save(Request $request, $id)
    {
        $mentor = User::where('id', $id)->first();
        if ($mentor) {
            $mentor->fname = $request->first_name;
            $mentor->email = $request->email ;
            $mentor->status = $request->status;
           
            $mentor->save();
            notify()->success('تم التعديل  !');
            return redirect()->back();

        } else {
            return redirect()->back()->with('error', 'please try again');
        }
    }

    public function password(Request $request)
    {
         $data = User::where('id', $request->id)->first();
        if ($data) {  
                $this->validate($request, [
                    'new_password' => [
                        'required',
                        'string',
                        'min:8',             // must be at least 10 characters in length
                        // 'regex:/[a-z]/',      // must contain at least one lowercase letter
                        //  'regex:/[0-9]/',      // must contain at least one digit
                                        ],
                    'password_confirmation' => 'required|same:new_password'
                ],$messages = [
                    'new_password.required' => '  كلمة المرور مطلوب!',
                    'new_password.string' => '  كلمة المرور غير صالحة!',
                    'new_password.min' => '  كلمة المرور يجب ان تحتوي على كثر من 8 حروف!',

                    'password_confirmation.same' => '  كلمة المرور غير متطابقة!',
                    'password_confirmation.required' => '  تأكيد كلمة المرور مطلوب! ',

                ]); 
                 
                $data->password = Hash::make($request->new_password);
             
            $data->save();


            notify()->success('تم تغيير كلمة السر  !');
            return redirect()->back();

        } else {
            return redirect()->back()->with('error', 'Your session expired');
        }
    }

       function uploadImage($folder, $image)
    {
        $image->store('/', $folder);
        $filename = $image->hashName();
        $path = $filename;
        return $path;
    }
    public function admin_delete(Request $request){

        $user = User::find($request->id);  
        if( $user){

            $user->delete();
      
            return response()->json([
                'status' => true,
                'msg' => 'deleted!',
                'id' =>  $request -> id
            ]);
        } 
 }

}
