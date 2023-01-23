<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Properity extends Model
{
    use HasFactory;

    protected $table='properties';

    protected $guarded = [];
    protected $casts = [
        'amenities' => 'array'
    ];

    protected $appends = array('main_image_url');

    public function getMainImageUrlAttribute()
    {
        if ($this->main_image) {
            return asset('images/' . $this->main_image);
        }
    }

    ########################################################
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
     public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
     public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }
    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_id', 'id');
    }
    // public function users()
    // {
    //     return $this->hasMany(User::class, 'user_id', 'id');
    // }
    public function rating()
    {
        return $this->belongsTo(Rating::class);
    }
    public function album()
    {
        return $this->hasMany(Album::class);
    }

    public function pro_cate()
    {
        return $this->hasMany(Pro_cate::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'properity_features');
    }
    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'properity_amenities');
    }
    public function nearby_places()
    {
        return $this->belongsToMany(NearbyPlace::class, 'properitiy_nearby');
    }
    public function like()
    {
        return $this->hasMany(Like::class, 'property_id');
    }
    // public static function validateRoles()
    // {

    //    return [
    //         'title' => 'bail|required',
    //         'description' => 'bail|required',
    //         'type_id' => 'required',
    //         'category_id' => 'required',
    //         'country_id' => 'required',
    //         'city_id' => 'required',
    //         'user_id' => 'required',
    //         'image' => 'image',
    //         'address' => 'required',
             

    //     ];
    // }
}

