<?php

namespace App\Http\Controllers;
use App\Models\Product; 
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function qtyproduct()
    {  
      $products = Product::get();
      foreach($products as $product){
        if($product->code){            
        $qty =  Http::get('https://db.alwansolar.com/api/getqty/' . $product->code);
        if($qty->status() == 200){
        $product->quantity = $qty;
        $product->save();
           }
        }
      }
      notify()->success('تم  تحديث الكميات!');
      return redirect()->back();
    }
    

    
}
