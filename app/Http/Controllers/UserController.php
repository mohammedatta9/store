<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\Models\Property;
use Validator, Redirect, Response;
use DB, Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\GeneralTrait;

class UserController extends Controller
{
    use GeneralTrait;


    public function save_properity(PropertyRequest $request)
    {
        if ($request->user()) {
            $user =  Auth::user();

    $validator = Validator::make($request->all(), [
        'title' => 'required',
        'description' => 'required',
        'type_id' => 'required',
        'category_id' => 'required',
        'address' => 'required',
        'lat' => 'required',
        'log' => 'required',
        'country_id' => 'required',
        'city_id' => 'required',
        'street' => 'required',
        'price' => 'required',
        'currency_id' => 'required',
        ],$messages = [
            'title.unique' => 'الاسم مستخدم بالفعل!',
            'description.required' => 'الوصف   مطلوب!',
            'type_id.required' => 'النوع مطلوب',
            'category_id.required' => 'التصنف  مطلوبة',
        ]);

       if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $property = new Property([
                'title' => $request->get('title'),
                'description' => $request->get('description'),
                'type_id' => $request->get('type_id'),
                'category_id' => $request->get('category_id'),
                'address' => $request->get('address'),
                'lat' => $request->get('lat'),
                'log' => $request->get('log'),
                'country_id' => $request->get('country_id'),
                'city_id' => $request->get('city_id'),
                'street' => $request->get('street'),
                'price' => $request->get('price'),
                'currency_id' => $request->get('currency_id'),
                'status' => 1,
                'user_id'=>$user->id,
            ]);

        $property->save();

        return $this->returnData('property', $property);
         }else{
            return $this->returnError('401', 'يجب عليك تسجيل الدخول');
         }
    }

    public function update_properity(Request $request){
        if ($request->user()) {
            $user = Auth::user();
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'type_id' => 'required',
                'category_id' => 'required',
                'address' => 'required',
                'lat' => 'required',
                'log' => 'required',
                'country_id' => 'required',
                'city_id' => 'required',
                'street' => 'required',
                'price' => 'required',
                'currency_id' => 'required',
            ],$messages = [
                'title.unique' => 'الاسم مستخدم بالفعل!',
                'description.required' => 'الوصف مطلوب!',
                'type_id.required' => 'النوع مطلوب',
                'category_id.required' => 'التصنيف مطلوب',
            ]);

            if ($validator->fails()) {
                return $this->returnError('401', $validator->errors());
            }
            $property = Property::find($request->get('id'));
            $property->title = $request->get('title');
            $property->description = $request->get('description');
            $property->type_id = $request->get('type_id');
            $property->category_id = $request->get('category_id');
            $property->address = $request->get('address');
            $property->lat = $request->get('lat');
            $property->log = $request->get('log');
            $property->country_id = $request->get('country_id');
            $property->city_id = $request->get('city_id');
            $property->street = $request->get('street');
            $property->price = $request->get('price');
            $property->currency_id = $request->get('currency_id');
            $property->update();

        }
    }
    public function security_settings(Request $request)
    {
        $user = \auth()->user()->id;
        $data = User::where('id', $user)->first();
        if ($data) {
            // try {

            if (isset($request->email) && $request->email != $data->email) {
                $this->validate($request, [
                    'email' => 'unique:users'
                ],$messages = [
                    'email.unique' => ' هذا الايميل مستخدم من قبل!',]);
                $data->email = $request->email;
            }

            if (isset($request->old_password)) {
                $this->validate($request, [
                    'new_password' => [
                        'required',
                        'string',
                        'min:8',             // must be at least 10 characters in length
                        'regex:/[a-z]/',      // must contain at least one lowercase letter
                         'regex:/[0-9]/',      // must contain at least one digit
                                        ],
                    'password_confirmation' => 'required|same:new_password'
                ],$messages = [
                    'new_password.required' => '  كلمة المرور مطلوب!',
                    'new_password.string' => '  كلمة المرور غير صالحة!',
                    'new_password.min' => '  كلمة المرور يجب ان تحتوي على كثر من 8 حروف!',

                    'password_confirmation.same' => '  كلمة المرور غير متطابقة!',
                    'password_confirmation.required' => '  تأكيد كلمة المرور مطلوب! ',

                ]);


                if (!Hash::check($request->old_password, $data->password)) {
                    return response()->json([
                        'message' => "كلمة المرور القديمة لا تطابق كلمة مرورك الحالية"
                    ], 422);
                }
                $data->password = Hash::make($request->new_password);
            }

            if (isset($request->fname))
                $data->fname = $request->fname;
            if (isset($request->fname)) {
                $data->lname =  $request->lname;
            }  

            $data->save();


            return response()->json([
                'message' => "تم تعديل بيانات الحساب"
            ]);

        } else {
            return redirect()->route('login')->with('error', 'Your session expired');
        }

    }


    public function location(Request $request)
    {

        $this->validate($request, [
            'email' => ['required'],
            'name' => ['required'],
            'area' => ['required'],
            'phone' => ['required'],
            'street' => ['required'],

        ],$messages = [
            'email.required' => ' الايميل مطلوب !',
            'house.required.' => ' الشقة\المنزل مطلوب   !',
            'phone.required' => ' رقم الهاتف مطلوب   !',
            'area.required' => ' المنطقة مطلوب   !',
            'name.required' => ' الاسم مطلوب   !', ]);
            try{
                $user = \auth()->user()->id;
        $data = new Address();
        if ($data) {
            // try {
                $data->user_id = $user;
                $data->name = $request->name;
                $data->email = $request->email;
                $data->area = $request->area;
                $data->street = $request->street;
                $data->Blvd = $request->Blvd;
                $data->house = $request->house;
                $data->phone = $request->phone;
            $data->save();

            notify()->success('تم اضافة العنوان !');
            return redirect()->back();


        } else {
            return redirect()->route('login')->with('error', 'Your session expired');
        }
            } catch (\Exception $e){

                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
        

    }

    
    public function delete_address(Request $request)
    {  
        $address = Address::find($request->id);
        
        $address->delete();
                            
        return response()->json([
            'status' => true,
            'id' => $request->id,
        ]);

    }
}
