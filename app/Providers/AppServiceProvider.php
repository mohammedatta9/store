<?php

namespace App\Providers;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.layoutSite.Footer', function ($view) {
            $setting = Setting::all();
            $footer_logo = $setting->where('key', 'footer_logo')->first()->value;
            $phone = $setting->where('key', 'phone1')->first()->value;
            $address = $setting->where('key', 'address')->first()->value;
            $email = $setting->where('key', 'email')->first()->value;
            $footer_about = $setting->where('key', 'footer_about')->first()->value;
            $facebook_link = $setting->where('key', 'facebook_link')->first()->value;
            $Linkedin_link = $setting->where('key', 'Linkedin_link')->first()->value;
            $youtube_link = $setting->where('key', 'youtube_link')->first()->value;
            $twitter_link = $setting->where('key', 'twitter_link')->first()->value;
        // $setting['setting'] = $collection->flatMap(function ($collection) {
        //     return [$collection->key => $collection->value];
        // });
        
            $view->with('footer_logo',$footer_logo)
            ->with('phone',$phone)
            ->with('address',$address)
            ->with('email',$email)
            ->with('footer_about',$footer_about)
            ->with('facebook_link',$facebook_link)
            ->with('Linkedin_link',$Linkedin_link)
            ->with('youtube_link',$youtube_link)
            ->with('twitter_link',$twitter_link) ;  // this is line 22 
        });

        view()->composer('layouts.layoutSite.Header', function ($view) {
            
            if(Auth::user()){
            $user_id = Auth::user()->id;
            $order = Order::where('user_id', $user_id)->latest()->first();

            }else{  $order = 1;}         

            $setting = Setting::all();
            $categories = Category::all();

            $facebook_link = $setting->where('key', 'facebook_link')->first()->value;
            $instagram_link = $setting->where('key', 'instagram_link')->first()->value;
            $twitter_link = $setting->where('key', 'twitter_link')->first()->value;
            $setting = Setting::all();
            $header_logo = $setting->where('key', 'header_logo')->first()->value;         
        
            $view->with('header_logo',$header_logo)->with('order',$order) ->with('facebook_link',$facebook_link)
            ->with('instagram_link',$instagram_link)
            ->with('categories',$categories)
            ->with('whatsapp_link',$twitter_link);   // this is line 22 
        });

        view()->composer('layouts.layoutSite.SitePage', function ($view) {
            $setting = Setting::all();
            $address = $setting->where('key', 'address')->first()->value;
            $email = $setting->where('key', 'email')->first()->value;
            $facebook_link = $setting->where('key', 'facebook_link')->first()->value;
            $instagram_link = $setting->where('key', 'instagram_link')->first()->value;
            $youtube_link = $setting->where('key', 'youtube_link')->first()->value;
            $twitter_link = $setting->where('key', 'twitter_link')->first()->value;
       
        
            $view->with('address',$address)
            ->with('email',$email)
             ->with('facebook_link',$facebook_link)
            ->with('instagram_link',$instagram_link)
            ->with('youtube_link',$youtube_link)
            ->with('twitter_link',$twitter_link) ;  // this is line 22 
        });
         view()->composer('site.homePage.contact', function ($view) {
            $setting = Setting::all();
             $phone = $setting->where('key', 'phone1')->first()->value;
            $address = $setting->where('key', 'address')->first()->value;
            $email = $setting->where('key', 'email')->first()->value;
            
        // $setting['setting'] = $collection->flatMap(function ($collection) {
        //     return [$collection->key => $collection->value];
        // });
        
            $view->with('phone',$phone)
            ->with('address',$address)
            ->with('email',$email);

        });
        // view()->composer('site.homePage.about', function ($view) {
        //     $setting = Setting::all();
        //     $section1_title = $setting->where('key', 'section1_title')->first()->value;
        //     $section2_title = $setting->where('key', 'section2_title')->first()->value;
        //     $section2_details = $setting->where('key', 'section2_details')->first()->value;
        //     $section1_details = $setting->where('key', 'section1_details')->first()->value;
        //     $section3_details = $setting->where('key', 'section3_details')->first()->value;
        //     $section4_details = $setting->where('key', 'section4_details')->first()->value;
        //     $section5_details = $setting->where('key', 'section5_details')->first()->value;
        //     $section1_url = $setting->where('key', 'section1_url')->first()->value;
        //     $section4_image = $setting->where('key', 'section4_image')->first()->value;
        //     $section5_image = $setting->where('key', 'section5_image')->first()->value;
             
        
        //     $view->with('section1_title',$section1_title)
        //     ->with('section2_title',$section2_title)
        //      ->with('section1_details',$section1_details)
        //     ->with('section2_details',$section2_details)
        //     ->with('section3_details',$section3_details)
        //     ->with('section4_details',$section4_details) 
        //     ->with('section5_details',$section5_details)
        //     ->with('section1_url',$section1_url)
        //     ->with('section4_image',$section4_image)
        //     ->with('section5_image',$section5_image);  // this is line 22 
        // });

        Schema::defaultStringLength(191);
    }
}
