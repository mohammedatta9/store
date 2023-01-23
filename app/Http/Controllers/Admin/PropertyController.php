<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Properity;
use App\Models\Type;
use App\Models\Country;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Album;


class PropertyController extends Controller
{
      public function properties_list()
    {
       
        return view('admin.properties.list');
    }
    public function propertiesajax(Request $request)
    {

        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page
        if ($request->get('order') == 'title') {
            $rorder = "title";
        } else {
            $rorder = $request->get('order');
        }
        $columnIndex_arr = $rorder;
        $columnName_arr = $request->get('columns');
        $order_arr = $rorder;
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        //$columnName = $columnName_arr[$columnIndex]['data']; // Column name
        if ($columnName_arr[$columnIndex]['data'] == 'title') {
            $columnName = "title";
        } else {
            $columnName = $columnName_arr[$columnIndex]['data'];
        }

        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Properity::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Properity::select('count(*) as allcount')->where('title', 'like', '%' . $searchValue . '%')->orWhere('description', 'like', '%' . $searchValue . '%')->orWhere('address', 'like', '%' . $searchValue . '%')->count();
        $records = Properity::orderBy($columnName, $columnSortOrder)
            ->where('title', 'like', '%' . $searchValue . '%')
            ->orWhere('description', 'like', '%' . $searchValue . '%')
            ->orWhere('address', 'like', '%' . $searchValue . '%')
            ->select('*')
            ->skip($start)
            ->take($rowperpage)
            ->orderBy('id', 'desc')
            ->get();


        // Fetch records


        $data_arr = array();

        foreach ($records as $record) {
            $id = $record->id;
            $title = $record->title;
            $type = $record->type->name;
            $category = $record->category->name;
            $image = $record->main_image;
            $price = $record->price;
            $space = $record->space;
            $created_at = $record->created_at->format('d/m/Y');

            $data_arr[] = array(
                "id" => $id,
                "title" => $title,
                "type" => $type,
                "category" => $category,
                "price" => $price,
                "created_at" => $created_at,
                "space" => $space,
                "image" => '<img src="/storage/property/'.$image.'"  width="80">   ',
                "actions" => '
                <a href="' . route('admin.property.profile', [$record->id]) . '"><i class=" far fa-eye  text-secondary font-20"></i></a>&nbsp;&nbsp;
                <a href="' . route('admin.property.delete', [$record->id]) . '" onclick=" return confirm( `  Are you sure? ` )"><i class=" las la-trash text-secondary font-20"></i></a>
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
    
  

   
    public function property_profile($id)
    {
         $types = Type::get();
        $countries = Country::get();
        $cities = City::get();
        $property = Properity::find($id);
        if($property ){
            return view('admin.properties.profile', [
                'property' => $property,  
                'countries' => $countries, 
                'cities' => $cities, 
                'types' => $types,      
            ]);   
         }
        return redirect()->back();
    }
    

    public function property_save(Request $request)
    {
        $request->validate([
            'name' => 'required',
 
        ]);
        $property =new property();
        
        $property->name =  $request->name;
       
        $property->save();
 
          if($property) {
              return redirect()->back()->with('message', 'SAVED!');
           } else  {
               return redirect()->back()->with('error', 'There is an error in your data');
          }    

 
    }


    public function property_edit(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required|max:304',
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
                'type_id.required' => 'الاسم مطلوب',
                'category_id.required' => ' النوع مطلوبة',
            ]); 

               
           $property =  Properity::find($request->id );
   
           if (request()->main_image != null) {
               $main_image = $this->uploadImage('property', $request->file('main_image'));
               $property->main_image =  $main_image;
           }
           
           $property->featured =  $request->featured;
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
    function uploadImage($folder, $image)
    {
        $image->store('/', $folder);
        $filename = $image->hashName();
        $path = $filename;
        return $path;
    }
    public function delete_property($id)
    {  
        $property =  Properity::find($id);
        
        $property->delete();
                            
        return redirect()->back()->with('success', '   Deleted!');

    }

}
