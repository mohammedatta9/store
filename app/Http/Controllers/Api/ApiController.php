<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Properity;
use App\Models\Property;
use App\Models\Tag;
use App\Models\Type;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    use GeneralTrait;
    public function getAllType()
    {
        $types = Type::all();
        return response()->json($types);
    }

    public function getType($id)
    {
        $type = Type::find($id);
        return response()->json($type);
    }
    public function getAllCountry()
    {
        $countries = Country::all();

        return response()->json($countries);
    }

    public function getCountry($id)
    {
        $country = Country::find($id);
        // $city = $country->cities()->get();

        return response()->json([
            'country' => $country,
            // 'city' => $city
        ]);
    }
    public function getAllCities()
    {
        $cities = City::all();
        return response()->json($cities);
    }

    public function getCity($id)
    {
        $city = City::find($id);
        return response()->json($city);
    }
    public function getAllCategories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function getCategory($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }
    public function getAllTags()
    {
        $tags = Tag::all();
        return response()->json($tags);
    }

    public function getTag($id)
    {
        $tag = Tag::find($id);
        return response()->json($tag);
    }
    public function getAllCurrencies()
    {
        $currencies = Currency::all();
        return response()->json($currencies);
    }

    public function getCurrency($id)
    {
        $currency = Currency::find($id);
        return response()->json($currency);
    }
    public function getLatestProperties()
    {
        $properties = Properity::latest()->paginate(10);
        return response()->json($properties);
    }

    public function getProperty($id)
    {
        $property = Properity::find($id);
        $city = $property->city()->get();
        $country = $property->country()->get();
        $type = $property->type()->get();
        $tag = $property->tag()->get();
        $category = $property->category()->get();
        $currency = $property->currency()->get();

        return response()->json([
            'property' => $property,
            'country' => $country,
            'city' => $city,
            'type' => $type,
            'tag' => $tag,
            'category' => $category,
            'currency' => $currency,
        ]);
    }

    public function getPropertiesByCity($city_id)
    {
        $properties = Properity::where('city_id', '=', $city_id)->get();
        return response()->json($properties);
    }

    public function getPropertiesByCountry($country_id)
    {
        $properties = Properity::where('country_id', '=', $country_id)->get();
        return response()->json($properties);
    }
}
