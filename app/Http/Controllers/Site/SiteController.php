<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Setting;
use App\Models\Carousel;
use App\Models\Type;
use App\Models\Category;
use App\Models\City;

use App\Models\Mailing;

use App\Models\Properity;


class SiteController extends Controller
{
    public function viewMyAccountPage()
    {
       $cities = City::get();
        $id = auth()->user()->id;
        $properties = Properity::where('user_id', $id)->latest()->get() ;
        $countries = Country::get();
        $mailings = Mailing::where('user_id', $id)->latest()->get() ;
        return view('site.userPages.myAccount', ['properties'=> $properties , 'cities'=> $cities , 'mailings'=> $mailings]);
    }

    public function wishlist()
    {
        $products[] = auth()->user()->products;

        return view('site.userPages.wishlist', ['products'=> $products ]);
    }
    
    public function viewHomePage()
    {
        $carousels = Carousel::latest()->get();

        return view('site.homePage.homePage', ['carousels'=> $carousels]);
    }





    public function viewContact()
    {
       
        return view('site.homePage.contact');
    }

    public function viewAboutUs()
    {
        $data = Setting::all()->where('key', 'section5_details')->first()->value;

        return view('site.homePage.about')->with('data',$data);
    }

    public function Shipping()
    {        
        $data = Setting::all()->where('key', 'section2_details')->first()->value;

        return view('site.homePage.Shipping')->with('data',$data);
    }
    public function questions()
    {  
        $data = Setting::all()->where('key', 'section4_details')->first()->value;

        return view('site.homePage.questions')->with('data',$data);
    }
    public function conditions()
    {
        $data = Setting::all()->where('key', 'section3_details')->first()->value;

        return view('site.homePage.conditions')->with('data',$data);
    }
    public function policy()
    { 
        $data = Setting::all()->where('key', 'section1_details')->first()->value;

        return view('site.homePage.policy')->with('data',$data);
    }
    
}
