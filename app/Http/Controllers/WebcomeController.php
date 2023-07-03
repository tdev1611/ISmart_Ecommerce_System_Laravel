<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category_product;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class WebcomeController extends Controller
{

    // ----------------------------------------1
    function indexx()
    { //phone
        
        // $phoneCategory = Category_product::where('name', 'điện thoại')->first();
        // $phoneProducts = $phoneCategory->productsRecursive();
        $categories = Category_product::where('status', 1)->whereNull('cat_parent')->get();
        $renderMenu = $this->renderCategory($categories);                // gọi đệ quy 
        // featured product
        $featured = Product::where('status', 1)->where('featured_products', 1)->get();

        // sp sale best
           $bestSellingProducts = Order::select('order_detail')
            ->whereNotNull('order_detail')
            ->get()
            ->flatMap(function ($order) {
                return json_decode($order->order_detail, true);
            })
            ->groupBy('id')
            ->map(function ($orders) {
                return [
                    'product_id' => $orders[0]['id'],
                    'name' => $orders[0]['name'],
                    'price' => $orders[0]['price'],
                    // 'price' => $orders[0]['price'],
                    'slug' => $orders[0]['options']['slug'],
                    'images' => $orders[0]['options']['images'],
                    'total_sold' => collect($orders)->sum('qty'),
                ];
            })
            ->sortByDesc('total_sold')
            ->take(6)
            ->values();

        return view('welcome', compact('renderMenu', 'categories', 'featured', 'bestSellingProducts'));
    }


    // --- --- --- --- --- --- --- ---// --- --- --- --- --- --- --- ---// --- --- --- --- --- --- --- ---





    //seacrh
    function searchIndex(Request $request)
    {
        $categories = Category_product::where('status', 1)->whereNull('cat_parent')->get();
        $renderMenu = $this->renderCategory($categories);                // gọi đệ quy 
        $products = Product::all();
         $searchIndex = request()->search;
        if (!empty($searchIndex)) {
            $products = Product::where('name', 'like', '%' . $searchIndex . '%')
                ->orWhere('slug', 'like', '%' . $searchIndex . '%')
                ->orderByDesc('created_at')
                ->paginate(10);
        } elseif ($searchIndex == null) {
            return redirect(route('homes'));
        }

        return view('Products.searchProduct', compact('products', 'renderMenu', 'searchIndex'));
    }


    // đệ quy xuất danh mục
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
