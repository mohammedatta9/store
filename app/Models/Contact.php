<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table='contact';

    protected $fillable = [
        'name', 'email' ,'phone', 'type_id' ,'message', 'created_at','updated_at'
    ];

    public function type()
    {
        return $this->belongsTo(Type::class,'type_id','id');
    }


}
