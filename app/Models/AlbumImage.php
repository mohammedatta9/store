<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AlbumImage extends Model
{
    use HasFactory;
    protected $table='album_images';

    protected $fillable = [
        'name', 'album_id','image'
    ];
    public function albums()
    {
        return $this->hasMany(Album::class, 'album_id', 'id');
    }
    // public function getImageUrlAttribute()
    // {
    //     if ($this->image) {
    //         //return asset('uploads/' . $this->image);
    //         return Storage::disk('uploads')->url($this->image);
    //     }

    //     return asset('images/default-image.jpg');
    // }
    public static function validateRoles()
    {
        return [
            'name' => 'required',
            'album_id' => 'required',
            'image' => 'required|image',

        ];
    }
}
