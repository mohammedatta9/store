<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table='ratings';

    protected $fillable = [
        'user_id','properity_id','rating','comment','status'
    ];

    public function properities()
    {
        return $this->hasMany(Properity::class, 'properity_id', 'id');
    }
    public function users()
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    } 

    public static function validateRoles()
    {
        return [
            'user_id' => 'required',
            'properity_id' => 'required',
            'rating' => 'required',
            'comment' => 'required',
            'status' => 'required',

        ];
    }
}
