<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Properity; 
use App\Models\Product; 
use App\Models\Type;
use App\Models\Country;
 
use App\Models\Category;
use App\Models\City;
use App\Models\Album;

use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function viewBuyProperty()
    {
        $properties = Properity::where('category_id', 1)->latest()->paginate(10);
        $types = Type::get();
        $categories = Category::get();
        return view('site.homePage.buyProperty', compact('properties','types','categories'));
    }

    public function viewSaleProperty()
    {
        $types = Type::get();
        $countries = Country::get();
        $cities = City::get();
        $properties = Properity::where('category_id', 1)->latest()->paginate(10); 
        return view('site.homePage.saleProperty', compact('properties','types','cities','countries'));
    }

    public function viewRentProperty()
    {
        $properties = Properity::where('category_id', 2)->latest()->paginate(10);
        $types = Type::get();
        $categories = Category::get();

        return view('site.homePage.rentProperty', compact('properties','types','categories'));
    }
    
    public function search_property(Request $request)
    {
     
      $title = $request->title;
      $types = Type::get();
      $categories = Category::get();
      $a =1.00;

      $products = Product::when(!empty($a) , function ($query) use($a){
        return $query->where('quantity', '>=', $a);
          }) ->when(!empty($title) , function ($query) use($title){
            return $query->where('name','like','%'. $title . '%')->orWhere('description','like','%'. $title . '%');
                }) ->latest()->paginate(10);
        
       
      return view('site.homePage.searchProperty', compact('products','types','categories'));

    }

    public function category_property($id)
    {
      $categories = Category::get();

       $category = Category::find($id);
      if($category){
        $a =1.00;
        $products = Product::when(1 , function ($query) use($id){
          return $query->where('category_id', 'like','%'. $id . '%');
              }) 
              ->when(!empty($a) , function ($query) use($a){
                return $query->where('quantity', '>=', $a);
                  }) 
                 ->paginate(10);
             
        return view('site.homePage.category_product', compact('products','category','categories'));
      }else{
        return redirect()->back();
      }

      

    }

    public function searcha_property(Request $request)
    {   

    
  
      $category = $request->category;
       if( $request->range ==1 ){
        $price1 = 15;
        $price = 5;
       }elseif( $request->range ==2 ){
        $price1 = 30;
        $price = 15;
       }elseif( $request->range ==3 ){
        $price1 = 45;
        $price = 30;
       }elseif( $request->range ==4 ){
        $price1 = 60;
        $price = 45;
       }else{
        $price1 = null;
        $price = null;
       }
       $a =1.00;
         $products = Product::when(!empty($category) , function ($query) use($category){
                                        return $query->where('category_id' , $category);
                                    })
                                     ->when(!empty($price) , function ($query) use($price){
                                      return $query->where('price' ,'>=' , $price);
                                        })
                                        ->when(!empty($price1) , function ($query) use($price1){
                                          return $query->where('price' ,'<=' , $price1);
                                      })  ->when(!empty($a) , function ($query) use($a){
                                        return $query->where('quantity', '>=', $a);
                                          })
                                      ->paginate(10);
     
        $categories = Category::get();
        
      return view('site.homePage.searchProperty', compact('products' ,'categories'));

    }

    public function viewProperty($id)
    {
        $product = Product::find($id);
        // $property = Properity::where('id', $id)->with('user')->first();
        
        if($product ){
          $types = Type::get();

         $category = $product->category_id;
        $products = Product::where('category_id', $category)->latest()->limit(4)->get();
        return view('site.homePage.propertyDetails',compact('product','products','types'));
    }
       return redirect()->back();
    }
    public function get_cities($name)
    {       
      $cities = City::where('country_id' , $name)->pluck("name", "id");
       return $cities; 
    }

    public function edit_property(Request $request)
    {
        
           
            $request->validate([
            'title' => 'required',
            'description' => 'required|max:300',
            'type_id' => 'required',
            'category_id' => 'required',
            'address' => 'required',
            'country_id' => 'required',
            'main_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048', 
            'space' => 'numeric',
            'price' => 'numeric',
              ],$messages = [
                'title.required' => 'عنوان العقار مطلوب!',
                'description.required' => '  الوصف مطلوب!',
                'description.max' => '   عدد الاحرف المسموح به 300 حرف',
                'type_id.required' => 'الاسم مطلوب',
                'category_id.required' => ' النوع مطلوبة',
                 'address.required' => ' العنوان مطلوبة',
                'category_id.numeric' => '  فقط رقم  ',
                'category_id.required' => '    فقط رقم',
                'space.numeric' => '  فقط رقم  ',
                'price.numeric' => '    فقط رقم',
            ]); 

               
           $property =  Properity::find($request->id );
   
           if (request()->main_image != null) {
               $main_image = $this->uploadImage('property', $request->file('main_image'));
               $property->main_image =  $main_image;
           }
           

           $property->title =  $request->title;
           $property->description =  $request->description;
           $property->type_id =  $request->type_id;
           $property->category_id =  $request->category_id;
           $property->address =  $request->address;
           $property->country_id =  $request->country_id;
           $property->city_id =  $request->city_id;

           $property->tax =  $request->tax;
           $property->built_year =  $request->built_year;
           $property->lat =  $request->lat;
           $property->video_link =  $request->video_link;
           $property->log =  $request->log;
           $property->street =  $request->street;
           $property->price =  $request->price;
           $property->price_description =  $request->price_description;
           $property->currency_id =  $request->currency_id;
           $property->building_number =  $request->building_number;
           $property->space =  $request->space;
           $property->number_rooms =  $request->number_rooms;
           
           $property->number_bedrooms =  $request->number_bedrooms;
           $property->number_toilets =  $request->number_toilets;
           $property->garage_space =  $request->garage_space;
           $property->available_from =  $request->available_from;
           $property->basement_space =  $request->basement_space;
           $property->extra_details =  $request->extra_details;
           $property->roof_space =  $request->roof_space;
           $property->floor_no	 =  $request->floor_no	;
           $property->number_floors =  $request->number_floors;
           $property->owner_note =  $request->owner_note;
           $property->amenities =  $request->amenities;
            
           
           $property->save();  
           
           $name[] = $request->file('album');
           $a= $request->a;
           for($i = 0; $i < count($a); $i++)
             {
              if( $name[$i] == ""){}else{
              $album =new Album();
              $album->properity_id = $property->id;
              $name = $this->uploadImage('property', $request->file('album')[$i]);
              $album->name =$name;         
              $album->save();
               }
             }
           if($property) {
                return redirect()->back()->with('success', 'تم تعديل البيانات!');
            } else  {
                return redirect()->back()->with('error', 'There is an error in your data');
            }
      
       
     
    }


    public function save_property(Request $request)
    { 
            $request->validate([
            'title' => 'required',
            'description' => 'required|max:300',
            'type_id' => 'required',
            'category_id' => 'required',
            'address' => 'required',
            'country_id' => 'required',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048', 
            'number_rooms' => 'numeric',
            'space' => 'numeric',
            'price' => 'numeric',
              ],$messages = [
                'title.required' => 'عنوان العقار مطلوب!',
                'description.required' => '  الوصف مطلوب!',
                'type_id.required' => 'الاسم مطلوب',
                'category_id.required' => ' النوع مطلوبة',
                'description.max' => '   عدد الاحرف المسموح به 300 حرف',
                'type_id.required' => 'الاسم مطلوب',
                  'address.required' => ' العنوان مطلوبة',
                'space.numeric' => '  فقط رقم  ',
                'price.numeric' => '    فقط رقم',
 
            ]);

              
           $property = new Properity();
   
           if (request()->main_image != null) {
               $main_image = $this->uploadImage('property', $request->file('main_image'));
               $property->main_image =  $main_image;
           }
           $property->user_id = auth()->user()->id;

           $property->title =  $request->title;
           $property->description =  $request->description;
           $property->type_id =  $request->type_id;
           $property->category_id =  $request->category_id;
           $property->address =  $request->address;
           $property->country_id =  $request->country_id;
           $property->city_id =  $request->city_id;

           $property->tax =  $request->tax;
           $property->built_year =  $request->built_year;
           $property->lat =  $request->lat;
           $property->video_link =  $request->video_link;
           $property->log =  $request->log;
           $property->street =  $request->street;
           $property->price =  $request->price;
           $property->price_description =  $request->price_description;
           $property->currency_id =  $request->currency_id;
           $property->building_number =  $request->building_number;
           $property->space =  $request->space;
           $property->number_rooms =  $request->number_rooms;
           
           $property->number_bedrooms =  $request->number_bedrooms;
           $property->number_toilets =  $request->number_toilets;
           $property->garage_space =  $request->garage_space;
           $property->available_from =  $request->available_from;
           $property->basement_space =  $request->basement_space;
           $property->extra_details =  $request->extra_details;
           $property->roof_space =  $request->roof_space;
           $property->floor_no	 =  $request->floor_no	;
           $property->number_floors =  $request->number_floors;
           $property->owner_note =  $request->owner_note;
           $property->amenities =  $request->amenities;
            
           
           $property->save();  

           $name[] = $request->file('album');
           $a= $request->a;
           for($i = 0; $i < count($a); $i++)
             {
              if( $name[$i] == ""){}else{
              $album =new Album();
              $album->properity_id = $property->id;
              $name = $this->uploadImage('property', $request->file('album')[$i]);
              $album->name =$name;         
              $album->save();
               }
             }
           
           if($property) {
                return redirect()->back()->with('success', 'تم حفظ البيانات!');
            } else  {
                return redirect()->back()->with('error', 'There is an error in your data');
            }
      
       
     
    }

    function uploadImage($folder, $image)
    {
        $image->store('/', $folder);
        $filename = $image->hashName();
        $path = $filename;
        return $path;
    }

    
    public function update_property($id)
    {
        $property = Properity::find($id);
        $types = Type::get();
        $countries = Country::get();
        $cities = City::get();
        return view('site.homePage.update_property', compact('property','types','cities','countries'));
    }
    public function delete_album(Request $request)
    {  
        $album =  Album::find($request->id);
        
        $album->delete();
                            
        return response()->json([
            'status' => true,
            'id' => $request->id,
        ]);

    }
}
