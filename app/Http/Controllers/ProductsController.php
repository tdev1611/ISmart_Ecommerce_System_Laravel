<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category_product;
use App\Models\Order;
use App\Models\Product;
use App\Models\Product_view;



class ProductsController extends Controller
{
    //
    // xuất sp danh mục category
    function productBycateID(Request $request)
    {
        $slug = $request->route('slug');
        $categories = Category_product::where('status', 1)->whereNull('cat_parent')->get();
        $renderMenu = $this->renderCategory($categories); // get cate menu
        // get san pham theo danh mục
        // cách 1 
        $category = Category_product::where('slug', $slug)->first();
        if ($category) {
            $categoryId = $category->id;
            $sub_categorys = Category_product::where('cat_parent', $categoryId)->get();
            $subCategoryIds = $sub_categorys->pluck('id')->toArray();
            $productByCate = Product::where('category_product_id', $categoryId)->orWhereIn('category_product_id', $subCategoryIds)->where('status', 1)->get();
        } else {
            abort(404);
        }
        //return json_encode($category);

        // ----- Cách 2: - Thiết lập quan hệ trong moddels
        // $category = Category_product::where('slug', $slug)->first();
        // $productByCate = $category->productsRecursive(); // lấy produc theo category

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
                    'slug' => $orders[0]['options']['slug'],
                    'images' => $orders[0]['options']['images'],
                    'total_sold' => collect($orders)->sum('qty'),
                ];
            })
            ->sortByDesc('total_sold')
            ->take(6)
            ->values();
        return view('Products.showCategory', compact('renderMenu', 'productByCate', 'category', 'bestSellingProducts'));
    }

    // sort category products
    function softProductsByCate(Request $request)
    {
        $slug = $request->route('slug');
        $category = Category_product::where('slug', $slug)->first();
        $categoryId = $category->id;

        $subCate = Category_product::where('cat_parent', $categoryId)->get(); // danh mục con
        $subCateIds = $subCate->pluck('id')->toArray(); // id danh mục con
        $products = Product::where('category_product_id', $categoryId)->orWhereIn('category_product_id', $subCateIds)->where('status', 1);

        // ----------------------
        // $products = Product::where('category_product_id', $categoryId)
        //     ->orWhereHas('category_product', function ($query) use ($categoryId) {
        //         $query->where('cat_parent', $categoryId);
        //     });

        $sort = $request->input('sortProdByCate');
        // $products  = Product::query();
        if ($sort === 'name_asc') {
            $products->orderBy('name', 'asc');
        } elseif ($sort === 'name_desc') {
            $products->orderBy('name', 'desc');
        } elseif ($sort === 'price_desc') {
            $products->orderBy('price', 'desc');
        } elseif ($sort === 'price_asc') {
            $products->orderBy('price', 'asc');
        } else {
            abort(404);
        }
        $sortdProducts = $products->get();
        $html_cate = view('Products.ajaxSortProductsByCate', compact('sortdProducts'))->render(); // data for ajjax
        return response()->json(['html_cate' => $html_cate]);
    }



    // --- --- --- --- --- --- --- ------ --- --- --- --- --- --- ------ --- --- --- --- --- --- ------ --- 
    function productDetail(Request $request)
    {
        $slug = $request->route('slug');
        $categories = Category_product::where('status', 1)->whereNull('cat_parent')->get();
        $renderMenu = $this->renderCategory($categories); // get cate menu
        $product = Product::where('slug', $slug)->first();

        if ($product) {
            $categoryId = $product->category_product_id;
            $relatedProducts = Product::where('category_product_id', $categoryId)->get();
        } else {
            abort(404);
        }

        $product_id = $product->id;
        $productView = Product_view::where('product_id', $product_id)->first();
        if ($productView) {
            $productView->increment('view_count');

        } else {
            Product_view::create(
                [
                    'product_id' => $product_id,
                    'view_count' => 1,
                ]
            );
        }

        // cmt
        $comments = $product->comments()->whereNull('parent_id')->paginate(5);

        // return $comments = Comment::with('product')->get();

        // cách 3:
        // product same
        //  danh mục chứa sản phẩm
        #C1 : 
        // $product_Id = $product->id;  //id product
        // $categoryProduct = Category_product::whereHas('product', function ($query) use ($product_Id) {
        //     $query->where('id', $product_Id);
        // })->first();

        // if ($categoryProduct) {
        //     $categoryId = $categoryProduct->id;
        //     // Lấy các sản phẩm cùng chuyên mục, loại trừ sản phẩm cần xem
        //     $relatedProducts = Product::whereHas('category_product', function ($query) use ($categoryId, $product_Id) {
        //         $query->where('category_product_id', $categoryId); // ///->where('id', '!=', $product_Id)
        //     })->limit(5)->get();
        // }
        #C2 : // set relationship trong models
        // $categoryProduct = $product->category_product;
        // $relatedProducts =   $categoryProduct->productsRecursive();


        //  sale best
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
                    'slug' => $orders[0]['options']['slug'],
                    'images' => $orders[0]['options']['images'],
                    'total_sold' => collect($orders)->sum('qty'),
                ];
            })
            ->sortByDesc('total_sold')
            ->take(6)
            ->values();
        return view('Products.detailproduct', compact('product', 'renderMenu', 'relatedProducts', 'comments', ));
    }


   
    // --- --- --- --- --- --- --- --- --- ----- --- --- --- --- --- --- ----- --- --- --- --- --- --- ---
    // show tab product
    function productShows(Request $request)
    {
        $categories = Category_product::where('status', 1)->whereNull('cat_parent')->get(); // duyệt menu
        $renderMenu = $this->renderCategory($categories); // get cate menu
        $categoriess = Category_product::where('status', 1)->whereNull('cat_parent')->paginate(2); // duyệt sản phẩm và phân trang

        $product_views = Product_view::orderBy('view_count','desc')->take(6)->get();
        //    $categoriess = Category_product::with('product')->get();

        return view('Products.showProduct', compact('renderMenu', 'categoriess','product_views' ));
    }

    // sortProduct product-show
    function sortProduct(Request $request)
    {
        $categories = Category_product::where('status', 1)->whereNull('cat_parent')->get(); // duyệt menu
        $renderMenu = $this->renderCategory($categories); // get cate menu

        // $sort = $_GET['sort'];
        $sort = $request->input('sort');
        $products = Product::query();
        if ($sort === 'name_asc') {
            $products->orderBy('name', 'asc');
        } elseif ($sort === 'name_desc') {
            $products->orderBy('name', 'desc');
        } elseif ($sort === 'price_desc') {
            $products->orderBy('price', 'desc');
        } elseif ($sort === 'price_asc') {
            $products->orderBy('price', 'asc');
        }
        // $sortdProducts = $products->get();
        $sortdProducts = $products->paginate(10);
        // $html = view('Products.ajaxsortproduct', compact('sortdProducts'))->render(); // data for ajjax


        // return response()->json(['html' => $html]);

        return view('Products.sortedProduct', compact('sortdProducts', 'renderMenu')); // sort submit
    }


    // --- --- --- --- --- --- --- --- ----- --- --- --- --- --- --- ----- --- --- --- --- --- --- ---
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

    //     <li>
    //     <a href="{{ route('homes') }}" title="">Trang chủ</a>
    // </li>
    // <li>
    //     <a href="{{ route('productShows') }}" title="">Sản phẩm</a>
    // </li>

}