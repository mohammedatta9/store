<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $table='currency';

    protected $fillable = [
        'name', 'value'
    ];
    public function properties()
    {
        return $this->belongsTo(Properity::class);
    }
    public static function validateRoles()
    {
        return [
            'name' => 'required',
            'value' => 'required',
        ];
    }
}
