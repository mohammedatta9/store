<?php

namespace App\Http\Controllers;
use App\Models\Order;

use Illuminate\Http\Request;
use AymanElmalah\MyFatoorah\Facades\MyFatoorah;

class MyFatoorahController extends Controller
{
    public function index() {
        $data = [
          'CustomerName' => 'New user',
          'NotificationOption' => 'all',
          'CustomerMobile' => '0000000000',
          'DisplayCurrencyIso' => 'KWD',
          'CustomerEmail' => 'test@test.test',
          'InvoiceValue' => '1000',
          'Language' => 'en',
          'CallBackUrl' => 'https://alwansolar.com/payment/callback',
          'ErrorUrl' => 'https://alwansolar.com/payment/error',
      ];
   
   // If you want to set the credentials and the mode manually.
   //    $myfatoorah = MyFatoorah::setAccessToken($token)->setMode('test')->createInvoice($data);
   
   // And this one if you need to access token from config
      $myfatoorah = MyFatoorah::createInvoice($data);
   
    // when you got a response from myFatoorah API, you can redirect the user to the myfatoorah portal 
    return response()->json($myfatoorah);
   }
   
   public function callback(Request $request) {
    $myfatoorah = MyFatoorah::payment($request->paymentId);
     
    $data = $myfatoorah->get();
    $InvoiceId = $data['Data']['InvoiceId'];
    $order = Order::where('payment_status', $InvoiceId)->first();
    $order->payment_statusp = $myfatoorah->isSuccess();
    $order->save();
 
    notify()->success(' تم ارسال الطلب ,  رجاءاً افحص البريد الالكتروني للتفاصيل');
    return redirect()->route('viewHomePage');
    
 }

 public function error(Request $request) {
    // Show error actions
    notify()->success(' تم ارسال الطلب ,  رجاءاً افحص البريد الالكتروني للتفاصيل');

    notify()->error(' علملية الدفع لم تتم   !');

    return redirect()->back();
}

}
