<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TypeController extends Controller
{
    public function types_list()
    {
        $types = Type::all();
        return view('admin.types.list', [
            'types' => $types,       
        ]);
    }

   
    public function type_profile($id)
    {
        $type = Type::find($id);
        if($type ){
            return view('admin.types.profile', [
                'type' => $type,       
            ]);   
         }
        return redirect()->back();
    }
    

    public function type_save(Request $request)
    {
        $request->validate([
            'name' => 'required',
 
        ]);
        $type =new Type();
        
        $type->name =  $request->name;
       
        $type->save();
 
          if($type) {
              return redirect()->back()->with('message', 'SAVED!');
           } else  {
               return redirect()->back()->with('error', 'There is an error in your data');
          }    

 
    }


    public function type_edit(Request $request)
    {
        $request->validate([
            'name' => 'required',
 
        ]);

        $id =  $request->id;
        $type = Type::find($id);
        
        $type->name =  $request->name;
       
        $type->save();
 
          if($type) {
              return redirect()->back()->with('message', 'SAVED!');
           } else  {
               return redirect()->back()->with('error', 'There is an error in your data');
          }    

 
    }

    public function delete_type(Request $request)
    {  
        $type =  Type::find($request->id);
        
        $type->delete();
                            
        return response()->json([
            'status' => true,
            'id' => $request->id,
        ]);

    }
}
