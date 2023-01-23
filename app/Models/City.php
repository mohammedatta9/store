<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table='cities';

    protected $fillable = [
        'name', 'status','country_id'
    ];
    public function properities()
    {
        return $this->hasMany(Properity::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public static function validateRoles()
    {
        return [
            'name' => 'required',
            'status' => 'required',
            'country_id' => 'required',

        ];
    }
}
