<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $table='colors';

    protected $fillable = [
        'name', 'product_id'
    ];
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    // public function album_image()
    // {
    //     return $this->belongsTo(AlbumImage::class);
    // }
    // public static function validateRoles()
    // {
    //     return [
    //         'name' => 'required',
    //         'properity_id' => 'required',
    //     ];
    // }
}
