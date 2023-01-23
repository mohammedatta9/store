<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProperityAmenitie extends Model
{
    use HasFactory;
    protected $table='properity_amenities';

    protected $fillable = [
        'properity_id','amenities_id'
    ];
}
