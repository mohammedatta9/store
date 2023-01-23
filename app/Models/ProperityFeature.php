<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProperityFeature extends Model
{
    use HasFactory;
    protected $table='properity_features';

    protected $fillable = [
        'properity_id','feature-id'
    ];
}
