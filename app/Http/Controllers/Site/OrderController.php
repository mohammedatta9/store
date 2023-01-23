<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\City;
use App\Models\Order;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Models\Discount;
use App\Models\OrderAddress;
use App\Notifications\OrderRequest;
use Illuminate\Support\Facades\Notification;
use App\Models\OrderItem;
use App\Models\Address; 
use AymanElmalah\MyFatoorah\Facades\MyFatoorah;

use App\Repositories\Cart\CartModelRepository;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class OrderController extends Controller
{
    public $address;
    protected $cart;
    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }
     
  
    public function index(Request $request)
    {    
        if($this->cart->total() == 0){
            notify()->error(' السلة فارغة ! ');

            return redirect()->route('viewHomePage');
        }
        $cities = City::get();
         if($request->address_id){
           $this->address = Address::find($request->address_id);
            $add =1;
            return view('site.homePage.order', [
                'cart' => $this->cart,
                'address' =>  $this->address,
                'add' =>  $add,
                'cities' =>  $cities,
            ]);
        }else{
            $add =2;
            return view('site.homePage.order', [
                'cart' => $this->cart,
                'add' =>  $add,
                'cities' =>  $cities,

            ]);
        }
       
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => ['required'],
            'name' => ['required'],
            'area' => ['required'],
            'phone' => ['required' , 'numeric'],
            'street' => ['required'],
           'payment_method' => ['required'],

        ],$messages = [
            'email.required' => ' الايميل مطلوب !',
            'house.required.' => ' الشقة\المنزل مطلوب   !',
            'phone.required' => ' رقم الهاتف مطلوب   !',
            'area.required' => ' المنطقة مطلوب   !',
            'payment_method.required' => '   مطلوب   !',
            'name.required' => ' الاسم مطلوب   !', ]);
            
            if($this->cart->total() == 0){
                notify()->error(' السلة فارغة ! ');
    
                return redirect()->route('viewHomePage');
            } 
            //register 
            if(isset($request->make_user)){ 
                $this->validate($request, [
                'email' => ['required', 'string', 'email','email:rfc' , 'max:255', 'unique:users'],
                'password' => ['required','confirmed', Rules\Password::defaults()],
                //'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/', 
            ],$messages =
                [   'email.unique' => ' الايميل مستخدم من قبل',
                    'password.confirmed' => 'كلمة المرور غير متطابقة',
                    'password.required' => 'كلمة المرور مطلوبة'
                    
                ]);
             
            $email = $request['email'];
           
            $user = User::create([
                
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => '1',
                'type' => '1'
            ]); 
        }
            try{

                
        $data1 = new Order();
        if ($data1) {
            // try {
                if(auth()->user()){
                    $user = \auth()->user()->id;
                    $data1->user_id = $user;
                }
                $data1->discount = $request->discount;
                $data1->nots = $request->nots;
                $data1->payment_method = $request->payment_method;
                $data1->total = $request->total;
                $data1->save();

                $address = new OrderAddress();
            
                $address->order_id = $data1->id;
                $address->name = $request->name;
                $address->email = $request->email;
                $address->area = $request->area;
                $address->street = $request->street;
                $address->Blvd = $request->Blvd;
                $address->house = $request->house;
                $address->phone = $request->phone;
                    $address->save();
                // return $this->cart->get();
                foreach($this->cart->get() as $a){
                    
                    $item = new OrderItem();
                            
                    $item->order_id = $data1->id;
                    $item->product_id = $a->product->id;
                    $item->product_name =$a->product->name;
                    $item->price = $a->product->price;
                    $item->quantity = $a->quantity; 
                        $item->save();
                }
                $this->cart->empty();
                $email = $address->email;
                if($email){
                    Notification::route('mail' ,$email)->notify(new OrderRequest($data1));
                }
                if($request->payment_method == "check"){
                    $data = [
                        'CustomerName' => $request->name,
                        'NotificationOption' => 'all',
                        'CustomerMobile' => $request->phone,
                        'DisplayCurrencyIso' => 'KWD',
                        'CustomerEmail' => $request->email,
                        'InvoiceValue' => $data1->total,
                        'Language' => 'en',
                        'CallBackUrl' => 'http://127.0.0.1:8000/payment/callback',
                        'ErrorUrl' => 'https://alwansolar.com/payment/error',
                    ];


                    $myfatoorah = MyFatoorah::createInvoice($data);
                    $data1->payment_status = $myfatoorah['Data']['InvoiceId'];
                    $data1->save();

                    return redirect($myfatoorah['Data']['InvoiceURL']);
                }

                if(isset($user)){ 
                    event(new Registered($user));
                    Auth::login($user);
                    notify()->success(' تم ارسال الطلب ,وتسجيل الدخول ,  رجاءاً افحص البريد الالكتروني للتفاصيل');
                    return redirect(RouteServiceProvider::HOME);
                }else{
            notify()->success(' تم ارسال الطلب ,  رجاءاً افحص البريد الالكتروني للتفاصيل');
            return redirect()->route('viewHomePage');
                }
                


        } else {
            return redirect()->back()->with('error', 'خطأ بالبيانات');
        }
            } catch (\Exception $e){

                return   $e->getMessage() ;
            }
            
    }
    
    public function showorder($id)
    {
       
        $order = Order::find($id);
        if($order){
            return view('site.homePage.ordershow', [
                 'order' =>  $order, 
            ]);
        }else{
            return redirect()->back();
        }
        

 
    }

    public function showorder2()
    {
       
      
            return view('site.homePage.ordershowa' );
        
        

 
    }
    public function delete_order(Request $request)
    {
        $order = Order::find($request->id);
        
        $order->delete();
                            
        return response()->json([
            'status' => true,
            'id' => $request->id,
        ]);

    }


    public function cartempty( )
    {
       
        $this->cart->empty();
        notify()->success(' تم افارغ  السلة!');
        return redirect()->route('viewHomePage');

    }
    
    public function discount(Request $request)
    {
       
       $discount = Discount::where('code', $request->code)->get()->first();
       if($discount){
        $rate = $discount->rate / 100;
        $cities = City::get();
         if($request->address_id){
           $this->address = Address::find($request->address_id);
            $add =1;
            return view('site.homePage.order', [
                'cart' => $this->cart,
                'address' =>  $this->address,
                'add' =>  $add,
                'cities' =>  $cities,
                'rate' =>  $rate,
                
            ]);
        }else{
            $add =2;
            return view('site.homePage.order', [
                'cart' => $this->cart,
                'add' =>  $add,
                'rate' =>  $rate,
                'cities' =>  $cities,

            ]);
        }
       }else{
        return redirect()->back();

       }
      
         
    }
    
    public function numberorder(Request $request)
    {    
          $order = Order::where('number', $request->number)->first();
          if($order){
            return view('site.homePage.ordershow', [
                 'order' =>  $order, 
            ]);
        }else{
            notify()->success('تاكد من رقم الطلب!');

            return redirect()->back();
        }
       
    }

}