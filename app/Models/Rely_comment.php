<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rely_comment extends Model
{
    use HasFactory;
    protected $fillable = ['content','user_id','product_id','parent_id'];

}
