<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'images', 'detail', 'status', 'price','sale_price', 'slug','category_name',
     'sale_price', 'desc','category_product_id','code','featured_products','list_images'];

    function category_product() {
        return $this->belongsTo('App\Models\Category_product',);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderByDesc('created_at');
    }

   
        function views(){
            return $this->hasMany('App\Models\Product_view');
        }

}
