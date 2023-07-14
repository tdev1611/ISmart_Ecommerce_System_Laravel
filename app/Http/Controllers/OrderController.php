<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use App\Mail\OrderSuccess;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    //

    function checkOut(Request $request)
    {
        $infoProduct = Cart::content();
     
        

        return view('cart.checkout', compact('infoProduct', ));
    }
    // xử lý order
    function payment(Request $request)
    {
        if ($request->payment_method == 1) {
            $cart = Cart::content();
            // foreach ($cart as $a) {
            //     $code_product = $a->options->code;
            // }
            $cart_json_encode = json_encode($cart);
            //# Array[] =>json_encode()=> insert database => json_decode($array,true)=> xuất giao diện
            $infoUser = Auth::user();
            $data = $request->all();
            $request->validate(
                [
                    'fullname' => 'required|min:2|max:50',
                    'email' => 'required|email|min:6|max:60',
                    'address' => 'required|min:10|',
                    'phone' => 'required|numeric|min:9'
                ]
            );

            // Lưu thông tin địa chỉ và số điện thoại vào session

            Session::put('fullname', $request->input('fullname'));
            Session::put('email', $request->input('email'));
            Session::put('phone', $request->input('phone'));
            Session::put('address', $request->input('address'));
            Session::put('note', $request->input('note'));

            // $data['note'] = $request->input('note');
            $code = 'UNI#' . Str::random(6);
            $data['code'] = $code; // code order
            $total = Cart::total();
            // $data['code_product'] = $code_product;   // code_product
            $data['customer_id'] = $infoUser->id;
            $data['totalCart'] = $total; // tổng sản phẩm
            $data['order_detail'] = $cart_json_encode;
            $data['created_at'] = date_format(now(), "Y/m/d H:i:s");
            Order::create($data);
            Mail::to($request->email)->send(new OrderSuccess($data));
            Cart::destroy();
            return redirect(route('thanksOrder'));
        } elseif ($request->payment_method == 2) {
            $cart = Cart::content();
            // foreach ($cart as $a) {
            //     $code_product = $a->options->code;
            // }
            $cart_json_encode = json_encode($cart);
            //# Array[] =>json_encode()=> insert database => json_decode($array,true)=> xuất giao diện
            $infoUser = Auth::user();
            $data = $request->all();
            $request->validate(
                [
                    'fullname' => 'required|min:2|max:50',
                    'email' => 'required|email|min:6|max:60',
                    'address' => 'required|min:10|',
                    'phone' => 'required|numeric|min:9'
                ]
            );

            // Lưu thông tin địa chỉ và số điện thoại vào session

            Session::put('fullname', $request->input('fullname'));
            Session::put('email', $request->input('email'));
            Session::put('phone', $request->input('phone'));
            Session::put('address', $request->input('address'));
            Session::put('note', $request->input('note'));

            // $data['note'] = $request->input('note');
            $code = 'UNI#' . Str::random(6);
            $data['code'] = $code; // code order
            $total = Cart::total();
            // $data['code_product'] = $code_product;   // code_product
            $data['customer_id'] = $infoUser->id;
            $data['totalCart'] = $total; // tổng sản phẩm
            $data['order_detail'] = $cart_json_encode;
            $data['created_at'] = date_format(now(), "Y/m/d H:i:s");
            Order::create($data);
            Mail::to($request->email)->send(new OrderSuccess($data));
            // Cart::destroy();
            return redirect()->route('paymentOnline');

        }

    }


    function orderSuccess(Request $request)
    {
        $id = Auth::user()->id; // 
        $order = Order::where('customer_id', $id)->orderBy('created_at', 'desc')->first(); // Lấy thông tin đơn hàng cuối cùng
        $order_detail = json_decode($order->order_detail, true); // Chuyển đổi dữ liệu order_detail từ chuỗi JSON sang mảng
        Cart::destroy();
        return view('Orders.ThanksOrder', compact('order', 'order_detail'));
    }


    function paymentOnline(Request $request)
    {
        $id = Auth::user()->id; // 
        $order = Order::where('customer_id', $id)->orderBy('created_at', 'desc')->first();
        $order_detail = json_decode($order->order_detail, true);

        return view('Orders.payOnline', compact('order', 'order_detail'));
    }

}