<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Amenity extends Model
{
    use HasFactory;
    protected $table='amenities';

    protected $fillable = [
        'name', 'image'
    ];

    public function properities()
    {
        return $this->belongsToMany(Properity::class, 'properity_amenities');
    } 
    public static function validateRoles()
    {
        return [
            'name' => 'required',
            'image' => 'required',
        ];
    }
}
