<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $table='options';

    protected $fillable = [
        'name', 'product_id'
    ];
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    } 
}
