<?php

namespace App\Http\Controllers;

use App\Models\Category_product;
use App\Models\Product;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class LayoutClientController extends Controller
{
    //




    // function menuresponsive()
    // {
    //     $categories = Category_product::where('status', 1)->whereNull('cat_parent')->get();
    //     $renderMenu = $this->renderCategory($categories);   // get cate menu                        
    //     return view('Products.searchProduct', compact('renderMenu',));
    // }    

    // menu da cap
    public function renderCategory($categories)
    {
        $html = '';
        foreach ($categories as $category) {
            $html .= '<li>';
            $html .= '<a href="' . route('productBycateID', ['slug' => $category->slug]) . '" title="">' . $category->name . '</a>';

            if ($category->children->count()) {
                $html .= '<ul class="sub-menu">';
                $html .= $this->renderCategory($category->children);
                $html .= '</ul>';
            }
            $html .= '</li>';
        }
        return $html;
    }
}
