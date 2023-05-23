<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class Category_product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'status', 'prioty', 'cat_parent'];

    function product()
    {
        return $this->hasMany('App\Models\Product')->where('status', 1);
    }


    public function children()
    {
        return $this->hasMany(Category_product::class, 'cat_parent'); // lấy   id trùng == cat_parent sub_cate
    }
    public function productsRecursive()
    {
        // Lấy ra danh sách sản phẩm của danh mục hiện tại và các danh mục con của nó. 
        //  vd : laptop : lấy ra sản phẩn của acer, msi
        $products = $this->product;
        foreach ($this->children as $child) {
            $products = $products->merge($child->productsRecursive());
        }
        return $products;
    }

//    public function productsRecursive($perPage = 10, $page = 1)
// {
//     $products = $this->product;
//     foreach ($this->children as $child) {
//         $products = $products->union($child->productsRecursive());
//     }
    
//     // Sử dụng phân trang của Laravel
//     $paginator = new Paginator($products, $perPage, $page);
    
//     return $paginator;
// }


    // xuất dữ liệu ở trang chủ
    public function childrenWC()
    {
        return $this->hasMany(Category_product::class, 'cat_parent'); // limit 
    }
    public function productsWCRecursive()
    {
        // Lấy ra danh sách sản phẩm của danh mục hiện tại và các danh mục con của nó. 
        //  vd : laptop : lấy ra sản phẩn của acer, msi
        $products = $this->product;
        foreach ($this->childrenWC as $child) {
            $products = $products->merge($child->productsWCRecursive());
        }
        return $products;
    }
}
