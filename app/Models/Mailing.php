<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mailing extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function properity()
    {
        return $this->belongsTo(Properity::class, 'properity_id', 'id');
    }
}
