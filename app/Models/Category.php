<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table='categories';

    protected $fillable = [
        'name', 'status'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id', 'id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function products()
    {
        return $this->hasMany(Properity::class);
    }
    public function pro_cate()
    {
        return $this->hasMany(ProCate::class);
    }
    public static function validateRoles()
    {
        return [
            'name' => 'required',
            'status' => 'required',
        ];
    }
}
