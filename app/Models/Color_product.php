<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color_product extends Model
{
    use HasFactory;
    protected $fillable = [
        'color_id','product_id'
    ];
}
