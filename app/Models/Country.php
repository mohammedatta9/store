<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    
    protected $table='countries';

    protected $fillable = [
        'name', 'status'
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
    public function properties()
    {
        return $this->hasMany(Properity::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function validateRoles()
    {
        return [
            'name' => 'required',
            'status' => 'required',
        ];
    }
}
