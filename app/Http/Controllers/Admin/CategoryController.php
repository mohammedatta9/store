<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categories_list()
    {
        $categories = Category::all();
        return view('admin.categories.list', [
            'categories' => $categories,       
        ]);
    }

   
    public function category_profile($id)
    {  
        $categories = Category::all();

        $category = Category::find($id);
        if($category ){
            return view('admin.categories.profile', [
                'category' => $category,       
                'categories' => $categories,       
            ]);    }
        return redirect()->back();
    }
    

    public function category_save(Request $request)
    {
        $request->validate([
            'name' => 'required',
 
        ]);
        $category =new Category();
        
        $category->name =  $request->name;
        $category->category_id =  $request->category_id;

        $category->save();
 
          if($category) {
            notify()->success('تم اضافة قسم !');

              return redirect()->back();
           } else  {
               return redirect()->back()->with('error', 'There is an error in your data');
          }    

 
    }


    public function category_edit(Request $request)
    {
        $request->validate([
            'name' => 'required',
 
        ]);

        $id =  $request->id;
        $category = Category::find($id);
        
        $category->name =  $request->name;
        $category->category_id =  $request->category_id;
       
        $category->save();
 
          if($category) {
            notify()->success('تم تعديل القسم !');

              return redirect()->back()->with('message', 'SAVED!');
           } else  {
               return redirect()->back()->with('error', 'There is an error in your data');
          }    

 
    }

    public function delete_category(Request $request)
    {  
        $category =  Category::find($request->id);
        
        $category->delete();
                            
        return response()->json([
            'status' => true,
            'id' => $request->id,
        ]);

    }
}
