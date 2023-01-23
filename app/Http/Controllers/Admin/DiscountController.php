<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Discount;

use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function discounts_list()
    {
        $discounts = Discount::all();
        return view('admin.discounts.list', [
            'discounts' => $discounts,       
        ]);
    }

   
    public function discount_profile($id)
    {
        $discount = Discount::find($id);
        if($discount ){
            return view('admin.discounts.profile', [
                'discount' => $discount,       
            ]);   
         }
        return redirect()->back();
    }
    

    public function discount_save(Request $request)
    {
        $request->validate([
            'code' =>  ['required','unique:discounts'],
            'rate' =>  ['required'],

        ]);
        $discount =new Discount();
        
        $discount->code =  $request->code;
        $discount->rate =  $request->rate;
       
        $discount->save();
 
          if($discount) {
            notify()->success('تم  الاضافة بنجاح  !');
              return redirect()->back();
           } else  {
               return redirect()->back()->with('error', 'There is an error in your data');
          }    

 
    }


    public function discount_edit(Request $request)
    {

        $id =  $request->id;
        $discount = Discount::find($id);

        if (isset($request->code) && $request->code != $discount->code) {
            $this->validate($request, [
                'code' => 'unique:discounts'
            ],$messages = [
                'code.unique' => ' هذا الكود مستخدم من قبل!',]);
                $discount->code =  $request->code;
            }
        $request->validate([
            'code' =>  ['required'],
            'rate' =>  ['required'],

 
        ]); 
        $discount->rate =  $request->rate;
      
        $discount->save();
 
          if($discount) {
              return redirect()->back()->with('message', 'SAVED!');
           } else  {
               return redirect()->back()->with('error', 'There is an error in your data');
          }    

 
    }

    public function delete_discount(Request $request)
    {  
        $discount =  Discount::find($request->id);
        
        $discount->delete();
                            
        return response()->json([
            'status' => true,
            'id' => $request->id,
        ]);

    }

}
