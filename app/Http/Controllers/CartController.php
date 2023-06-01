<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Models\Category_product;
use App\Models\Product;

class CartController extends Controller
{
    //
    function cartshow()
    {
         $cart =  Cart::content();
     
        return view('cart.cartShow', compact('cart'));
    }
    //add cart ajjax qty =1
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['error' => 'Product not found.']);
        }
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->price,
            'options' => [
                'images' => $product->images,
                'code' => $product->code,
                'slug' => $product->slug
            ],
        ]);
        $cartCount = Cart::count(); // Số lượng sản phẩm trong giỏ hàng
        $cartTotal = Cart::total() . 'Đ'; // Tổng giá trị của giỏ hàng
        // $cart = Cart::content();
        // foreach ($cart as $qty) {
        //     $qty_per = $qty->qty;    // số lượng từng phần từ ở card layouts
        // }
        $list_cart = view('cart.dropcart')->render(); // data for ajjax
        return response()->json([
            'success' => true,
            'cartCount' => $cartCount,
            'cartTotal' => $cartTotal,
            // 'qty_per' => $qty_per,
            'list_cart' => $list_cart,
        ]);
    }

    // thêm số lượng theo yêu cầu(view detailProduct) ajax
    public function addCartDetailAjax(Request $request)
    {
        $qty = $request->input('qty');
        $productId = $request->input('product_id');  
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['error' => 'Không tìm thấy sản phẩm.']);
        }
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $qty,
            'price' => $product->price,
            'options' => [
                'images' => $product->images,
                'code' => $product->code,
                'slug' => $product->slug,
            ],
        ]);
        $cartCount = Cart::count(); // Số lượng sản phẩm trong giỏ hàng
        $cartTotal = Cart::total(); // Tổng giá trị của giỏ hàng
        $list_cart = view('cart.dropcart')->render(); // data for ajjax
        // $cart = Cart::content();
        // foreach ($cart as $k => $v) {
        //     $qty_per = $k->qty;    // số lượng từng phần từ ở card layouts
        // }

        return response()->json([
            'success' => true,
            'cartCount' => $cartCount,
            'cartTotal' => $cartTotal,
            // 'qty_per' => $qty_per,
            'list_cart' => $list_cart,
        ]);
    }

    // add qty =1 
    function addCart($id)
    {
        $product = Product::find($id);
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,  // get số lượng sản phẩm 
            'price' => $product->price,
            'slug' => $product->slug,
            'options' => ['images' => $product->images, 'code' => $product->code]  // thông tin phụ   $item ->option->images
        ]);
        return redirect(route('cartshow'))->with('success', 'Thêm sản phẩm thành công');
    }

    // thêm số lượng theo yêu cầu(view detailProduct)
    function addCartDetail($id)
    {
        // $quantity = $request->input('num-order');

        $product = Product::find($id);
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $_GET['num-order'],  // get số lượng sản phẩm 
            'price' => $product->price,
            'slug' => $product->slug,
            'options' => ['images' => $product->images, 'code' => $product->code]
        ]);

        return redirect(route('cartshow'))->with('success', 'Thêm sản phẩm thành công');
    }

    //update ajax 
    function update(Request $request)
    {
        // Cập nhật giá tiền     // Cập nhật số lượng 
        $rowId = $request->input('rowId');
        $quantity = $request->input('quantity');
        Cart::update($rowId, $quantity);
        $item = Cart::get($rowId);
        // $subtotal = $item->subtotal;
        $subtotal = number_format($item->subtotal, 0, '', '.') . 'đ';
        // $total = Cart::total();
        $total = Cart::total() . ' Đ';

        $cartCount = Cart::count();
        return response()->json([
            'subtotal' => $subtotal,
            'total' => $total,
            'cartCount' => $cartCount,
            'quantity' => $quantity,

        ]);
    }

    //mua ngay
    function buyNow($id)
    {
     
        $product = Product::find($id);
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->price,
            'options' => [
                'images' => $product->images,
                'code' => $product->code,
                'slug' => $product->slug,
            ]  // thông tin phụ   $item ->option->images
        ]);
        return redirect(route('showCheckCount'));
    }
     //mua ngay- detail qty= qty
    function buyNowDetail(Request $request, $id)
    {
        $qty  = $request->num_order ;
        $product = Product::find($id);
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' =>  $qty,
            'price' => $product->price,
            'options' => [
                'images' => $product->images,
                'code' => $product->code,
                'slug' => $product->slug,
            ]  // thông tin phụ   $item ->option->images
        ]);
        return redirect(route('showCheckCount'));
    }
        
    
    //delte 1 
    function removeCart($rowId)
    {
        Cart::remove($rowId);
        return redirect(route('cartshow'))->with('success', 'Xóa sản phẩm thành công');
    }

    //destroy cart
    function destroy()
    {
        Cart::destroy();
        return redirect(route('cartshow'))->with('success', 'Xóa sản phẩm thành công');
    }
}
