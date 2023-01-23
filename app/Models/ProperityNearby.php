<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProperityNearby extends Model
{
    use HasFactory;
    protected $table = 'properity_features';

    protected $fillable = [
        'properity_id', 'feature-nearby_id', 'name', 'distance', 'lat', 'log'
    ];
    public static function validateRoles()
    {
        return [
            'properity_id' => 'required',
            'feature-nearby_id' => 'required',
            'name' => 'required',
            'distance' => 'required',
            'lat' => 'required',
            'log' => 'required',
        ];
    }
}
