<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $table='products';

    protected $guarded = [];

    ########################################################
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    
    public function album()
    {
        return $this->hasMany(Album::class);
    }

    public function pro_cates()
    {
        return $this->hasMany(ProCate::class);
    }
 
    public function color()
    {
        return $this->hasMany(Color::class);
    }
    public function option()
    {
        return $this->hasMany(Option::class);
    }
    public function like()
    {
        return $this->hasMany(Like::class, 'product_id');
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

