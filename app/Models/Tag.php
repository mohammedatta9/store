<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $table='tags';

    protected $fillable = [
        'name', 'status'
    ];

    public function properties()
    {
        return $this->hasMany(Properity::class);
    }
    
    public static function validateRoles()
    {
        return [
            'name' => 'required',
            'status' => 'required',
        ];
    }

}
