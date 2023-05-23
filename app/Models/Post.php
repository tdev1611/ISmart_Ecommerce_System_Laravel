<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'images', 'content', 'status', 'slug',
   'desc','category_post_id'];

   function category_post(){

    return $this->belongsTo('App\Models\Category_post');

   }
}
