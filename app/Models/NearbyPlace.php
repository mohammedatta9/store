<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class NearbyPlace extends Model
{
    use HasFactory;
    protected $table='nearby_places';

    protected $fillable = [
        'name', 'image','status'
    ];
    public function properities()
    {
        return $this->belongsToMany(Properity::class, 'properitiy_nearby');
    }
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            //return asset('uploads/' . $this->image);
            return Storage::disk('uploads')->url($this->image);
        }

        return asset('images/default-image.jpg');
    }
    public static function validateRoles()
    {
        return [
            'name' => 'required',
            'image' => 'required',
            'status' => 'required',
        ];
    }
}
