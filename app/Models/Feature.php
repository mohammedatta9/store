<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Feature extends Model
{
    use HasFactory;
    protected $table='features';

    protected $fillable = [
        'name', 'image','value'
    ];
    public function properities()
    {
        return $this->belongsToMany(Properity::class, 'properity_features');
    }
  
    public static function validateRoles()
    {
        return [
            'name' => 'required',
            'image' => 'required',
            'value' => 'required',
        ];
    }
}
