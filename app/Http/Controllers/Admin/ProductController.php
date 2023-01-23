<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Type;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Color;
use App\Models\Option;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;



class ProductController extends Controller
{
      public function products_list()
    {
       
        return view('admin.products.list');
    }
    public function product_add()
    {
        $category = Category::get();
        return view('admin.products.add', [
            'category' => $category,
         ]);   
    }
    
    public function productsajax(Request $request)
    {

        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page
        if ($request->get('order') == 'name') {
            $rorder = "name";
        } else {
            $rorder = $request->get('order');
        }
        $columnIndex_arr = $rorder;
        $columnName_arr = $request->get('columns');
        $order_arr = $rorder;
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        //$columnName = $columnName_arr[$columnIndex]['data']; // Column name
        if ($columnName_arr[$columnIndex]['data'] == 'name') {
            $columnName = "name";
        } else {
            $columnName = $columnName_arr[$columnIndex]['data'];
        }

        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Product::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Product::select('count(*) as allcount')->where('name', 'like', '%' . $searchValue . '%')->orWhere('description', 'like', '%' . $searchValue . '%')->count();
        $records = Product::orderBy($columnName, $columnSortOrder)
            ->where('name', 'like', '%' . $searchValue . '%')
            ->orWhere('description', 'like', '%' . $searchValue . '%')
            ->select('*')
            ->skip($start)
            ->take($rowperpage)
            ->orderBy('id', 'desc')
            ->get();


        // Fetch records

        $data_arr = array();

        foreach ($records as $record) {

            $id = $record->id;
            $name = $record->name;
            if($record->category){$c = $record->category->name;}else{$c= "";}
            $code = $record->code;
            $quantity = $record->quantity;
            $image = $record->image;
            $price = $record->price;
            $created_at = $record->created_at->format('d/m/Y');

            $data_arr[] = array(
                "id" => $id,
                "name" => $name,
                "code" => $code,
                "price" => $price,
                "created_at" => $created_at,
                "quantity" => '<form name="qty" id="qty"  action="'. route('editqty') .' "  method="POST">
               
                <input type="number" name="qty" style="width:50px"  maxlength="90" value="' . $record->quantity . '" >
                <input type="text" name="code" style="display:none" value="' . $record->code . '" >
                <input type="hidden" name="_token" value="'. csrf_token() .'" />

                       <button  id="qty_btn"  "><i class="icofont-save  text-success font-20"></i></button>
             
               </form>',
                "image" => '<img src="/storage/property/'.$image.'"  width="80">   ',
                "actions" => '
                <a href="' . route('admin.product.profile', [$record->id]) . '"><i class="icofont-eye  text-secondary font-20"></i></a>&nbsp;&nbsp;
                <a href="' . route('admin.product.delete', [$record->id]) . ' "  onclick=" return confirm( `  Are you sure? ` )"><i class="icofont-trash text-danger  "></i></a>
'

            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
    }
    
  

   
    public function product_profile($id)
    {
         $category = Category::get();
         $cities = City::get();
        $product = Product::find($id);
        
        $qty =  Http::get('https://db.alwansolar.com/api/getqty/' . $product->code);
        if($qty->status() == 200){
        $product->quantity = $qty;
        $product->save();}

        if($product ){
            return view('admin.products.profile', [
                'product' => $product,  
                'category' => $category, 
                'cities' => $cities, 
             ]);   
         }
        return redirect()->back();
    }
    

    public function product_save(Request $request)
    {  
            $request->validate([
            'name' => 'required|max:100',
            'code' => 'required|max:100',
            'description' => 'required|max:300',
            'category_id' => 'required',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048', 
            'quantity' => 'required',
            'price' => 'required',
              ],$messages = [
                'name.required' => 'اسم المنتج مطلوب!',
                'code.required' => 'رمز المنتج مطلوب!',
                'description.required' => '  الوصف مطلوب!',
                'category_id.required' => ' النوع مطلوبة',
                'main_image.required' => ' الصورة مطلوبة',
                'description.max' => '   عدد الاحرف المسموح به 300 حرف',
                'price.required' => ' السعر مطلوبة',
                'quantity.required' => ' الكمية مطلوبة',

            ]);

              try{
           $product = new Product();
   
           if (request()->main_image != null) {
               $main_image = $this->uploadImage('property', $request->file('main_image'));
               $product->image =  $main_image;
           }
           $product->name =  $request->name;
           $product->description = $request->description;
           $product->category_id = implode(' ',$request->category_id);
           $product->quantity = $request->quantity;
           $product->code =  $request->code;
           $product->size =$request->size;
           $product->guarantee = $request->guarantee;
           $product->sku = $request->sku;
           $product->price = $request->price	; 
           $product->price_alternative = $request->price_alternative; 
           $product->quantity = $request->quantity; 
           $product->status =  $request->status; 
           $product->save();  

           Http::post('https://db.alwansolar.com/api/qtydit', [
            'code' => $request->code,
            'qty' => $request->quantity,           
           ]);
           
           $name[] = $request->file('album');
           $a= $request->a;
           for($i = 0; $i < count($a); $i++)
             {
              if( isset($request->file('album')[$i])) {
              $album =new Album();
              $album->product_id = $product->id;
              $name = $this->uploadImage('property', $request->file('album')[$i]);
              $album->name =$name;         
              $album->save();
               }
             }
           
             
           $col[] = $request->color;
           $cc= $request->co;
           for($l = 0; $l < count($cc); $l++)
             {
                if( $request->color[$l] == ["#000000"]){}else{
              $c =new Color();
              $c->product_id = $product->id;              
              $c->color =$request->color[$l];         
              $c->save();
               
             }}

             $option[] = $request->option;
             $price[] = $request->price;
             $oo= $request->op;
             for($j = 0; $j < count($oo); $j++)
               {
                if( $request->option[$j] == [null]){}else{
                $op =new Option();
                $op->product_id = $product->id;              
                $op->name =$request->option[$j];  
                $op->price =$request->price[$j];                
                $op->save();
                 
               }}

           if($product) {
            notify()->success('تم اضافة منتج  !');
                return redirect()->back();
            } else  {
                return redirect()->back()->with('error', 'There is an error in your data');
            }
        }
        catch (\Exception $e){

            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
      
       
     
    }
    public function delete_color(Request $request)
    {  
        $color =  Color::find($request->id);
        
        $color->delete();
                            
        return response()->json([
            'status' => true,
            'id' => $request->id,
        ]);

    }

    public function delete_option(Request $request)
    {  
        $option =  Option::find($request->id);
        
        $option->delete();
                            
        return response()->json([
            'status' => true,
            'id' => $request->id,
        ]);

    }

    function uploadImage($folder, $image)
    {
        $image->store('/', $folder);
        $filename = $image->hashName();
        $path = $filename;
        return $path;
    }

    


    public function product_edit(Request $request)
    { $request->validate([
        'name' => 'required|max:100',
        'code' => 'required|max:100',
        'description' => 'required|max:300',
        'category_id' => 'required',
        'main_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048', 
        'price' => 'required',
          ],$messages = [
            'name.required' => 'اسم المنتج مطلوب!',
            'code.required' => 'رمز المنتج مطلوب!',
            'description.required' => '  الوصف مطلوب!',
            'category_id.required' => ' النوع مطلوبة',
            'description.max' => '   عدد الاحرف المسموح به 300 حرف',
          
        ]);

          
        $product =  Product::find($request->id);

       if (request()->main_image != null) {
           $main_image = $this->uploadImage('property', $request->file('main_image'));
           $product->image =  $main_image;
       }
       $product->name =  $request->name;
       $product->description = $request->description;
       $product->category_id = $request->category_id;
       $product->quantity = $request->quantity;
       $product->code =  $request->code;
       $product->size =$request->size;
       $product->guarantee = $request->guarantee;
       $product->sku = $request->sku;
       $product->price = $request->price	; 
       $product->price_alternative = $request->price_alternative; 
       $product->quantity = $request->quantity; 
       $product->status =  $request->status; 
       $product->save(); 

       Http::post('https://db.alwansolar.com/api/qtydit', [
        'code' => $request->code,
        'qty' => $request->quantity,           
       ]);
       $name[] = $request->file('album');
       $a= $request->a;
       for($i = 0; $i < count($a); $i++)
         {
          if( $name[$i] == ""){}else{
          $album =new Album();
          $album->product_id = $product->id;
          $name = $this->uploadImage('property', $request->file('album')[$i]);
          $album->name =$name;         
          $album->save();
           }
         }
       
         
       $col[] = $request->input('color');
        $cc= $request->co;
       for($i = 0; $i < count($cc); $i++)
         {
            if( $col[$i] ==["#000000"]){}else{
          $c =new Color();
          $c->product_id = $product->id;              
          $c->color =$request->color[$i];         
          $c->save();
           
         }}

         $option[] = $request->input('option');
         $price[] = $request->price;
         $oo= $request->op;
         for($i = 0; $i < count($oo); $i++)
           {
           
            if($option[$i] == [null] ){}else{
            $op =new Option();
            $op->product_id = $product->id;              
            $op->name =$request->option[$i];  
            $op->price =$request->price[$i];                
            $op->save();
             
           }
        }

       if($product) {
        notify()->success('تم التعديل  !');
            return redirect()->back();
        } else  {
            return redirect()->back()->with('error', 'There is an error in your data');
        }
       
 
    }
 
    public function delete_product($id)
    {  
        $product =  Product::find($id);
        
        $product->delete();
        notify()->success('تم الحذف  !');
        return redirect()->back();

    }

    public function editqty(Request $request)
    {   
        $product =  Product::where('code', $request->code)->first();
     
        $product->quantity =  $request->qty;
        $product->save();
        Http::post('https://db.alwansolar.com/api/qtydit', [
            'code' => $request->code,
            'qty' => $request->qty,           
        ]);
        if($product){
            notify()->success('تم تعديل الكمية !');
            return redirect()->back();
    
        }
       
    }

}
