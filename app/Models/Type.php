<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Type extends Model
{
    use HasFactory;

    protected $table = 'types';

    protected $fillable = [
        'name', 'image', 'status'
    ];

    protected $appends = array('image_url');

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('images/' . $this->image);
        }
    }

    ###########################################

    public function properties()
    {
        return $this->hasMany(Properity::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class,'type_id','id');
    }

    public static function validateRoles()
    {
        return [
            'name' => 'required',
            'image' => 'image',
            'status' => 'required',
        ];
    }


}
