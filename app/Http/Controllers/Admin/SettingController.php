<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
 use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
     
    public function index(){

        $collection = Setting::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });
        return view('admin.settings.index', $setting);
    }

    public function update(Request $request){
        
        try{
            $info = $request->except('_token', '_method', 'header_logo' , 'footer_logo','section5_image','section4_image','section3_image','section2_image','section1_image');
            foreach ($info as $key=> $value){
                Setting::where('key', $key)->update(['value' => $value]);
            }


            if($request->hasFile('header_logo')) {
                $logo_name = $this->uploadImage('users', $request->file('header_logo'));
                 Setting::where('key', 'header_logo')->update(['value' => $logo_name]);
             }
             if($request->hasFile('footer_logo')) {
                $footer_logo = $this->uploadImage('users', $request->file('footer_logo'));
                 Setting::where('key', 'footer_logo')->update(['value' => $footer_logo]);
             }
             if($request->hasFile('section1_image')) {
                $section1_image = $this->uploadImage('users', $request->file('section1_image'));
                 Setting::where('key', 'section1_image')->update(['value' => $section1_image]);
             }
             if($request->hasFile('section2_image')) {
                $section2_image = $this->uploadImage('users', $request->file('section2_image'));
                 Setting::where('key', 'section2_image')->update(['value' => $section2_image]);
             }
             if($request->hasFile('section3_image')) {
                $section3_image = $this->uploadImage('users', $request->file('section3_image'));
                 Setting::where('key', 'section3_image')->update(['value' => $section3_image]);
             }
             if($request->hasFile('section4_image')) {
                $section4_image = $this->uploadImage('users', $request->file('section4_image'));
                 Setting::where('key', 'section4_image')->update(['value' => $section4_image]);
             }
             if($request->hasFile('section5_image')) {
                $section5_image = $this->uploadImage('users', $request->file('section5_image'));
                 Setting::where('key', 'section5_image')->update(['value' => $section5_image]);
             }

             
            return  redirect()->back()->with('success', '  updated successfully');
        }
        catch (\Exception $e){

            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }

    function uploadImage($folder, $image)
    {
        $image->store('/', $folder);
        $filename = $image->hashName();
        $path = $filename;
        return $path;
    }
}
