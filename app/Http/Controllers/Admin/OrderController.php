<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
 use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use App\Models\Product;
use App\Notifications\AcceptRequest;
use Illuminate\Support\Facades\Notification;
use App\Repositories\Cart\CartModelRepository;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;


class OrderController extends Controller
{
    public function orders_list()
    {
        $orders = Order::where('status','1')->latest()->get();
        $a = 0;
        if($orders ){
        return view('admin.orders.list')->with('orders', $orders)->with('a', $a);
                }
                return redirect()->back();
    }

    public function sh_orders_list()
    {
        $orders = Order::where('status','2')->latest()->get();
        $a = 1;

        if($orders ){
        return view('admin.orders.list')->with('orders', $orders)->with('a', $a);
                }
                return redirect()->back();
    }

    public function order_profile($id)
    {
         
        $order = Order::find($id);
        $address = OrderAddress::where('order_id', $order->id )->first();
        if($order ){
            return view('admin.orders.profile', [
                'order' => $order,  
                'address' => $address, 
             ]);   
         }
        return redirect()->back();
    }
    public function shipping($id)
    {
         
        $order = Order::find($id);
        $address = OrderAddress::where('order_id', $order->id )->first();

        if($order ){
             foreach($order->items as $item ){
                if($item->product->quantity == 0){
                    $msg = " نفذت كمية المنتج " .  $item->product->name;
                    notify()->success($msg );
                    return redirect()->back( ); 
                }else{
                    $prod = Product::find($item->product->id);
                    $prod->quantity = $prod->quantity  - $item->quantity ;
                    $prod->save();
                }
             }
            $order->status = 2 ;
            $order->save();
            $email = $address->email;
            if($email){
                Notification::route('mail' ,$email)->notify(new AcceptRequest($order));
            }
           Http::post('https://db.alwansolar.com/api/order', [
            'date' => $order->created_at,
            'id' => $order->id,
            'name' => $address->name,
            'phone' => $address->phone,
            'total' => $order->total - 2, 
            'shipment_fees' => 2, 
            ]);
            
            foreach($order->items as $item){
                if($item->product->price_alternative ) {
                    $price=  $item->product->price_alternative;
                }else{
                    $price=  $item->product->price;
                }
                Http::post('https://db.alwansolar.com/api/orderitem', [
                    'order_id' => $order->id,
                    'line_no' => $loop->iteration,
                    'code' => $item->product->code,
                    'qty' => $item->quantity,
                    'price' => $price, 
                ]);
                Http::post('https://db.alwansolar.com/api/itemedit', [
                    'code' => $item->product->code,
                    'qty' => $item->quantity,
                   
                ]);
    
            }
           

            notify()->success(' تم اضافة المنتج بقائمة الطلبات المشحونة  واراسل ايميل !');
          return redirect()->route('admin.orders');
         }
        return redirect()->back();
    }
}
