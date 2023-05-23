<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_post extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'status','cat_parent'];
    function post()
    {
        return $this->hasMany('App\Models\Post');
    }

    function childs(){
        return $this->hasMany('App\Models\Category_post','cat_parent','id');  // cat_parent = id
    }

    
}
