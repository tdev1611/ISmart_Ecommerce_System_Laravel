<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected   $fillable = ['slug', 'name', 'desc'];

    function user()
    {

        return $this->hasOne('App\Models\User');
    }

    function permissions()
    {
        return $this->belongsToMany('App\Models\Permission','role_permission');  //table lk :role_permission
    }
}
